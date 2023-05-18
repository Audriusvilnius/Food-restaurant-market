<?php

namespace App\Http\Controllers;

use App\Mail\OrderBasket;
use Carbon\Carbon;
use App\Models\Food;
use App\Models\City;
use App\Models\Restaurant;
use App\Models\Front;
use App\Models\Order;
use App\Models\Category;
use App\Models\Ovner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Services\BasketService;
use App\Mail\OrderReceived;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{
    public function home(Request $request, City $city, FrontController $citySelect)
    {


        $sessionCity = Session::get('citySelect');
        $ovners = Ovner::all()->sortBy('title');
        $cities = City::all()->sortBy('title');
        if ($sessionCity == null) {
            return view('front.home.city', [
                'cities' => $cities,
                'ovners' => $ovners,
                'text' => Faker::create()->realText(300, 5),
            ]);
        }

        $restaurants = Restaurant::all()
            ->map(function ($temp) {
                $temp->deg = rand(-45, 45);
                $temp->translateX = rand(-70, -160);
                $temp->translateY = rand(-45, -45);
                return $temp;
            })->sortBy('title');

        $restaurants = $restaurants->map(function ($status) {
            $status->openStatus = Carbon::parse($status->open)->format('H:i');
            $status->closeStatus = Carbon::parse($status->close)->format('H:i');
            $check = Carbon::now('Europe/Vilnius')->between(
                $status->openStatus,
                $status->closeStatus,
            );
            if ($check == true) {
                $status->works = 'true';
            } else $status->works = 'false';
            return $status;
        });

        $categories = Category::all()->sortBy('title_' . app()->getLocale());
        $foods = Food::all()->sortBy('title_' . app()->getLocale());


        $perPageShow = in_array($request->per_page, Food::PER_PAGE) ? $request->per_page : 'All';
        $perPageShow_lt = in_array($request->per_page, Food::PER_PAGE_LT) ? $request->per_page : 'Visi';

        if (!$request->s) {
            if ($request->restaurant_id && $request->restaurant_id != 'all') {

                $foods = Food::where('rest_id', $request->restaurant_id);
                // ->where('food_city_no', $sessionCity);
                // ->get();
                // $foods = Food::where('rest_id', $request->restaurant_id);
            } else {
                // $foods = Food::where('id', '>', 0);
                $foods = Food::where('food_city_no', $sessionCity);
                if ($sessionCity == null) {
                    $foods = Food::where('id', '>', 0);
                }
            }

            $foods = match ($request->sort ?? '') {
                'asc_price' => $foods->orderBy('price'),
                'desc_price' => $foods->orderBy('price', 'desc'),
                'asc_name' => $foods->orderBy('title_' . app()->getLocale()),
                'desc_name' => $foods->orderBy('title_' . app()->getLocale(), 'desc'),
                'desc_rate' => $foods->orderBy('rating', 'desc'),
                    // 'desc_rest'=>Food::orderBy('title'),
                default => $foods
            };
            if ($perPageShow == 'All' || $perPageShow_lt == 'Visi') {
                $foods = $foods->where('food_city_no', $sessionCity)->get();
            } else {
                $foods = $foods->paginate($perPageShow)->withQueryString();
            }
        } else {
            $s = explode(' ', $request->s);
            if (count($s) == 1) {
                $foods = Food::where('title_' . app()->getLocale(), 'like', '%' . $request->s . '%')
                    ->orWhere('rest_title', 'like', '%' . $request->s . '%')
                    ->orWhere('price', 'like', '%' . $request->s . '%')
                    ->get();
            } else {
                $foods = Food::where('title_' . app()->getLocale(), 'like', '%' . $s[0] . '%' . $s[1] . '%')
                    ->orWhere('title_' . app()->getLocale(), 'like', '%' . $s[1] . '%' . $s[0] . '%')
                    ->orWhere('rest_title', 'like', '%' . $s[1] . '%' . $s[0] . '%')
                    ->orWhere('rest_title', 'like', '%' . $s[0] . '%' . $s[1] . '%')
                    ->get();
            }
        }

        return view('front.home.home', [
            'foods' => $foods,
            'restaurants' => $restaurants,
            'categories' => $categories,
            'cities' => $cities,
            'ovners' => $ovners,
            'sortSelect' => Food::SORT,
            'sortSelect_lt' => Food::SORT_LT,
            'sortShow' => isset(Food::SORT[$request->sort]) ? $request->sort : '',
            'sortShow_lt' => isset(Food::SORT_LT[$request->sort]) ? $request->sort : '',
            'perPageSelect' => Food::PER_PAGE,
            'perPageSelect_lt' => Food::PER_PAGE_LT,
            'perPageShow' => in_array($request->per_page, Food::PER_PAGE) ? $request->per_page : 'All',
            'perPageShow_lt' => in_array($request->per_page, Food::PER_PAGE_LT) ? $request->per_page : 'Visi',
            'typeShow' => $request->restaurant_id ? $request->restaurant_id : '',
            // 'cityShow'=>$request->restaurant_id ? $request->restaurant_id :'',
            's' => $request->s ?? ''
        ]);
    }
    public function reviews(Request $request, Food $food)
    {

        $food = Food::where('id', '=', $request->product)->first();

        $rateds = json_decode($food->rating_json, 1);
        if ($rateds != null) {
            usort($rateds, function ($b, $a) {
                return $a['date'] <=> $b['date'];
            });
        }
        // $request->user_name = Auth::user()->name;
        return view('front.reviews.index', [
            'rateds' => $rateds,
            'food' => $food,
            'id' => $request->product,
            // 'name' => Auth::user()->name,
        ]);
    }
    public function rate(Request $request, Food $food)
    {
        $food = Food::where('id', '=', $request->product)->first();
        // $faker = Faker::create();
        $rateds = json_decode($food->rating_json, 1);
        // $request->user_id = Auth::user()->id;
        // $request->user_name = Auth::user()->name;
        $date = date('Y-m-d H:i', time());

        if ($request->food_review == null) {
            $food_review = "The user doesn't leave a review, but..." . Faker::create()->realText($maxNbChars = 500, $indexSize = 2);
        } else {
            $food_review = $request->food_review;
        }
        // if ($request->rated == null) {
        //     $request->rated = rand(1, 5);
        // }

        if ($rateds) {
            $rateds[Auth::user()->id] = ['rate' => $request->rated, 'user_name' => Auth::user()->name, 'review' => $food_review, 'date' => $date];
        } else {
            $rateds = [Auth::user()->id => ['rate' => $request->rated, 'user_name' => Auth::user()->name, 'review' => $food_review, 'date' => $date]];
        }

        $arrysum = 0;
        $count = 0;
        foreach ($rateds as $key => $arr) {
            $arrysum += $arr['rate'];
            $count++;
        }

        $rating = $arrysum / $count;
        $rateds = json_encode($rateds);

        DB::table('food')->where('id', $request->product)->update(['rating_json' => $rateds]);
        DB::table('food')->where('id', $request->product)->update(['rating' => $rating]);
        DB::table('food')->where('id', $request->product)->update(['counts' => $count]);

        return redirect(url()->previous() . '#' . Auth::user()->id)->with('ok', 'You rate ' . $food->title . ' ' . $request->rated . ' points');
    }

    public function addToBasket(Request $request, Food $food, BasketService $basket)
    {
        if ($request->food_city_no != Session::get('citySelect') || $request->food_city_no != Auth::user()->city_id) {
            $city = City::where('id', '=', $request->food_city_no)->first();
            $local = City::where('id', '=', Session::get('citySelect'))->first();
            $food = Food::where('id', '=', $request->id)->first();
            if ($request->food_city_no != Session::get('citySelect')) {
                if (app()->getLocale() == "lt") {
                    $message = 'Pasirinkimas ' . $food->title_lt . ' yra ' . $city->title . ' mieste . Jūsų miestas ' . $local->title .  '. Pasirunkit patiekalą iš ' . $local->title . ' miesto';
                } else {
                    $message = 'The selected dish is not in ' . $city->title . ' city. You choose ' . $local->title . '. Choose another dish or change city';
                }
            }
            if ($request->food_city_no != Auth::user()->city_id) {
                if (app()->getLocale() == "lt") {
                    $message = 'Žodžiu taip, ' . $food->title_lt . ' yra kitam mieste, nei ' . Auth::user()->name . ' vartotojo miesta. Pasirink kita patiekalą arba kita pristatymo miesta';
                } else {
                    $message = 'The selected dish is not in ' . $city->title . ' city. You choose ' . $local->title . '. Choose another dish or change city';
                }
            }

            return redirect(url()->previous() . '#' . $request->id)->with('not', $message);
        } else {
            $food = Food::where('id', '=', $request->id)->first();
            $id = (int)$request->id;
            $count = (int)$request->count;
            $basket->add($id, $count);

            if (app()->getLocale() == "lt") {
                $message1 = $food->title_lt . ' ' . $request->count . 'vnt. sėkmingai įdėta į krepšelį';
            } else {
                $message1 = $food->title_en . ' ' . $request->count . 'pcs. succesfully added to the basket';
            }
            return redirect(url()->previous() . '#' . $request->id)->with('ok', $message1);
        }
    }

    public function viewBasket(Request $request, BasketService $basket)
    {
        $delivery = [];

        foreach ($basket->list as $data) {

            if ($data->rest_id) {
                $delivery[$data->rest_id] = ['rest_id' => $data->rest_id];
            } else {
                $delivery = [$data->rest_id => ['rest_id' => $data->rest_id]];
            }
        }
        $delivery = count($delivery) * 4.99;
        $totals = $basket->total + $delivery;
        Session::put('total', $totals);

        // dd(Session::get('total', $totals));
        return view('front.home.basket', [
            'basketList' => $basket->list,
            'delivery' => $delivery,
            'totals' => $totals,
        ]);
    }

    public function updateBasket(Request $request, BasketService $basket)
    {

        if ($request->delete) {
            $basket->delete($request->delete);
        } else {
            $updatedBasket = array_combine($request->ids ?? [], $request->count ?? []);
            $basket->update($updatedBasket);
        }
        return redirect(url()->previous() . '#' . $request->id)->with('ok', 'Update complete');
    }

    public function makeOrder(Request $request,  BasketService $basket)
    {
        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->order_json = json_encode($basket->order());
        $order->save();
        $order->basket_json = json_encode($basket->bascet_order($order->id));
        $order->save();

        // dd($order);
        $to = User::find($order->user_id);

        // Mail::to($to)->send(new OrderBasket($order));
        $basket->empty();
        return redirect()->route('start')->with('ok', 'Order coplete, Thank you for the order, see you soon ');
    }


    public function listRestaurants(Request $request, Restaurant $restaurant)
    {
        // dump(Carbon::parse(now('Europe/Vilnius'))->format('H:i'));
        $foods = Food::where('rest_id', $restaurant->id)
            ->where('food_city_no', Session::get('citySelect'))
            ->get();

        // $foods = Food::where('food_city_no', Session::get('citySelect'))->get();

        $categories = Category::all()->sortBy('title');
        $ovners = Ovner::all()->sortBy('title');
        $cities = City::all()->sortBy('title');
        $restaurants = Restaurant::all();
        $foods = $foods->sortBy('title_' . app()->getLocale());

        $restaurants = $restaurants->map(function ($status) {
            $status->deg = rand(-45, 45);
            $status->translateX = rand(-70, -160);
            $status->translateY = rand(-45, -45);
            $status->openStatus = Carbon::parse($status->open)->format('H:i');
            $status->closeStatus = Carbon::parse($status->close)->format('H:i');
            $check = Carbon::now('Europe/Vilnius')->between(
                $status->openStatus,
                $status->closeStatus,
            );
            if ($check == true) {
                $status->works = 'true';
            } else $status->works = 'false';
            return $status;
        });

        $restaurants->sortBy('city');
        return view('front.home.restaurant', [
            'restaurants' => $restaurants,
            'restaurant' => $restaurant->title,
            'foods' => $foods,
            'cities' => $cities,
            'categories' => $categories,
            'ovners' => $ovners,
            'sortSelect' => Food::SORT,
            'sortSelect_lt' => Food::SORT_LT,
            'sortShow' => isset(Food::SORT[$request->sort]) ? $request->sort : '',
            'sortShow_lt' => isset(Food::SORT_LT[$request->sort]) ? $request->sort : '',
            'perPageSelect' => Food::PER_PAGE,
            'perPageSelect_lt' => Food::PER_PAGE_LT,
            'perPageShow' => in_array($request->per_page, Food::PER_PAGE) ? $request->per_page : 'All',
            'perPageShow_lt' => in_array($request->per_page, Food::PER_PAGE_LT) ? $request->per_page : 'Visi',
            'typeShow' => $request->restaurant_id ? $request->restaurant_id : '',
            // 'cityShow'=>$request->restaurant_id ? $request->restaurant_id :'',
            's' => $request->s ?? ''
        ]);
    }

    public function listCategory(Request $request, Category $category, City $city)
    {
        // dump(Session::get('citySelect'));
        // $categories=Category::all()->sortBy('title');
        $ovners = Ovner::all()->sortBy('title');
        $cities = City::all()->sortBy('title');
        $restaurants = Restaurant::all();

        $foods = Food::where('food_category_no', $category->id)
            ->where('food_city_no', Session::get('citySelect'))
            ->get();
        $foods = $foods->sortBy('title_' . app()->getLocale());

        $category_en = $category->title_en;
        $category_lt = $category->title_lt;

        $restaurants = $restaurants->map(function ($status) {
            $status->deg = rand(-45, 45);
            $status->translateX = rand(-70, -160);
            $status->translateY = rand(-45, -45);
            $status->openStatus = Carbon::parse($status->open)->format('H:i');
            $status->closeStatus = Carbon::parse($status->close)->format('H:i');
            $check = Carbon::now('Europe/Vilnius')->between(
                $status->openStatus,
                $status->closeStatus,
            );
            if ($check == true) {
                $status->works = 'true';
            } else $status->works = 'false';
            return $status;
        });



        return view('front.home.category', [
            'restaurants' => $restaurants,
            'foods' => $foods,
            'cities' => $cities,
            'city' => $city,
            // 'categories'=>$categories,
            'category_en' => $category_en,
            'category_lt' => $category_lt,
            'ovners' => $ovners,
            'sortSelect' => Food::SORT,
            'sortSelect_lt' => Food::SORT_LT,
            'sortShow' => isset(Food::SORT[$request->sort]) ? $request->sort : '',
            'sortShow_lt' => isset(Food::SORT_LT[$request->sort]) ? $request->sort : '',
            'perPageSelect' => Food::PER_PAGE,
            'perPageSelect_lt' => Food::PER_PAGE_LT,
            'perPageShow' => in_array($request->per_page, Food::PER_PAGE) ? $request->per_page : 'All',
            'perPageShow_lt' => in_array($request->per_page, Food::PER_PAGE_LT) ? $request->per_page : 'Visi',
            'typeShow' => $request->restaurant_id ? $request->restaurant_id : '',
            // 'cityShow'=>$request->restaurant_id ? $request->restaurant_id :'',
            's' => $request->s ?? ''
        ]);
    }

    public function city(Request $request)
    {
        $citySelect = $request->city_id;
        Session::put('citySelect', $citySelect);
        return redirect()->back();
    }
    public function getCity(Request $request)
    {
        $sessionCity = Session::get('citySelect');
        $ovners = Ovner::all()->sortBy('title');
        $cities = City::all()->sortBy('title');
        if ($sessionCity == null) {
            return view('front.home.city', [
                'cities' => $cities,
                'ovners' => $ovners,
                'text' => Faker::create()->realText(300, 5),
            ]);
        }
    }
}
