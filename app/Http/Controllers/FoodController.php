<?php

namespace App\Http\Controllers;

// use App\Http\Requests\Request;
use App\Models\Food;
use App\Models\City;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all()->sortBy('title');
        $categories = Category::all()->sortBy('title');

        if (Auth::user()->role == 'admin') {
            $foods = Food::orderBy('created_at', 'desc')->get();
        } elseif (Auth::user()->role == 'user' && Auth::user()->rest_id != null && Auth::user()->city_id != null) {
            $foods = Food::where('rest_id', Auth::user()->rest_id)
                ->where('food_city_no', Auth::user()->city_id)
                ->get();
        }
        return view('back.food.index', [
            'foods' => $foods,
            'cities' => $cities,
            'categories' => $categories,
        ]);
    }
    public function copyRestTitle()
    {

        if (app()->getLocale() == "lt") {
            $message1 = "Restorano pavadinimas sėkmingai nukopijuotas";
        } else {
            $message1 = "Restaurants title succesfully copied";
        }
        $foods = food::all();

        foreach ($foods as $food) {
            $fooR = Restaurant::where('id', '=', $food->rest_id)->first();
            $fooC = Category::where('id', '=', $food->food_category_no)->first();
            $food->rest_title = $fooR->title;
            // $catetObj = (object)[
            //     'id' => $fooC->id,
            //     'title' => $fooC->title,
            //     'photo' => $fooC->photo,
            //     'link' => route('list-category', $fooC->id)
            // ];
            // $restObj = (object)[
            //     'id' => $fooR->id,
            //     'title' => $fooR->title,
            //     'photo' => $fooR->photo,
            //     'link' => route('list-restaurant', $fooR)
            // ];
            $food->cate_json = json_encode((object)[
                'id' => $fooC->id,
                'title' => $fooC->title,
                'photo' => $fooC->photo,
                'link' => route('list-category', $fooC->id)
            ], JSON_FORCE_OBJECT);

            $food->rest_json = json_encode((object)[
                'id' => $fooR->id,
                'title' => $fooR->title,
                'photo' => $fooR->photo,
                'link' => route('list-restaurant', $fooR)
            ], JSON_FORCE_OBJECT);
            $food->save();
        }
        return redirect()->back()->with('ok', $message1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $cities = City::all()->sortBy('city');
        $categories = Category::all()->sortBy('title');
        if (Auth::user()->role == 'admin') {
            $restaurants = Restaurant::all()->sortBy('title');
        } elseif (Auth::user()->role == 'user' && Auth::user()->rest_id != null && Auth::user()->city_id != null) {
            // $restaurants = Restaurant::where('id', Auth::user()->rest_id)
            //     ->get();
            $restaurants = Restaurant::all()->sortBy('title');
        }

        return view('back.food.create', [
            'restaurants' => $restaurants,
            'cities' => $cities,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'food_title_en' => 'required|nullable',
                'food_title_lt' => 'required|nullable',
                'food_price' => 'required|decimal:0,2|min:0|max:999',
                // 'photo' => 'required|nullable',
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $food = new Food;

        if ($request->file('photo')) {
            $photo = $request->file('photo');
            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name . '-' . time() . '.' . $ext;
            $photo->move(public_path() . '/images', $file);
            $food->photo = '/' . 'images/' . $file;
        } else {
            $food->photo = '/images/temp/noimage.jpg';
        }

        $food->rest_id = $request->restaurant_id;
        $food->food_city_no = $request->city_id;
        $food->food_category_no = $request->category_id;

        $foo = Restaurant::where('id', '=', $food->rest_id)->first();

        $restObj = (object)[];
        $restObj = (object)[
            'id' => $foo->id,
            'title' => $foo->title,
            'photo' => $foo->photo,
            'link' => route('list-restaurant', $foo)
        ];
        $food->rest_json = json_encode($restObj, JSON_FORCE_OBJECT);

        $foo = Category::where('id', '=', $food->food_category_no)->first();
        $catetObj = (object)[];
        $catetObj = (object)[
            'id' => $foo->id,
            'title' => $foo->title,
            'photo' => $foo->photo,
            'link' => route('list-category', $foo->id)
        ];
        $food->cate_json = json_encode($catetObj, JSON_FORCE_OBJECT);

        $food->rest_title = $foo->title;
        $food->title_en = $request->food_title_en;
        $food->title_lt = $request->food_title_lt;
        $food->price = $request->food_price;
        $food->des_en = $request->food_des_en;
        $food->des_lt = $request->food_des_lt;
        $food->add = $request->food_add;
        $food->rating = 0;
        $food->counts = 0;
        $food->save();

        return redirect()->route('foods-index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        return view('back.food.index', [
            'food' => $food
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit(Food $food)
    {

        $cities = City::all()->sortBy('city');
        $categories = Category::all()->sortBy('title');
        if (Auth::user()->role == 'admin') {
            $restaurants = Restaurant::all()->sortBy('title');
        } elseif (Auth::user()->role == 'user' && Auth::user()->rest_id != null && Auth::user()->city_id != null) {
            // $restaurants = Restaurant::where('id', Auth::user()->rest_id)
            //     ->get();
            $restaurants = Restaurant::all()->sortBy('title');
        }
        return view('back.food.edit', [
            'food' => $food,
            'restaurants' => $restaurants,
            'cities' => $cities,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Food $food)

    {
        if ($request->delete_photo) {
            $food->deletePhoto();

            if (app()->getLocale() == "lt") {
                $message1 = "Nutrauka ištrinta";
            } else {
                $message1 = "Photo deleted";
            }
            return redirect()->back()->with('ok', $message1);
        }

        $validator = Validator::make(
            $request->all(),
            [
                'food_title_lt' => 'required|nullable',
                'food_title_en' => 'required|nullable',
                'food_price' => 'required|decimal:0,2|min:0|max:999',
                // 'photo' => 'required|nullable',
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }


        if ($request->file('photo')) {
            $photo = $request->file('photo');
            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name . '-' . time() . '.' . $ext;

            if ($food->photo) {
                $food->deletePhoto();
            }

            $photo->move(public_path() . '/images', $file);
            //$country->photo=asset('/images').'/'.$file;
            $food->photo = '/' . 'images/' . $file;
        }

        $food->title_lt = $request->food_title_lt;
        $food->title_en = $request->food_title_en;
        $food->price = $request->food_price;

        $food->rest_id = $request->restaurant_id;
        $food->food_city_no = $request->city_id;
        $food->food_category_no = $request->category_id;

        $foo = Restaurant::where('id', '=', $food->rest_id)->first();
        $restObj = (object)[];
        $restObj = (object)[
            'id' => $foo->id,
            'title' => $foo->title,
            'photo' => $foo->photo,
            'link' => route('list-restaurant', $foo)
        ];
        $food->rest_json = json_encode($restObj, JSON_FORCE_OBJECT);

        $foo = Category::where('id', '=', $food->food_category_no)->first();
        $catetObj = (object)[];
        $catetObj = (object)[
            'id' => $foo->id,
            'title' => $foo->title,
            'photo' => $foo->photo,
            'link' => route('list-category', $foo->id)
        ];
        $food->cate_json = json_encode($catetObj, JSON_FORCE_OBJECT);

        $food->rest_title = $foo->title;
        $food->des_en = $request->food_des_en;
        $food->des_lt = $request->food_des_lt;
        $food->add = $request->food_add;

        $food->save();
        if (app()->getLocale() == "lt") {
            $message1 = "Redagavimas baigtas";
        } else {
            $message1 = "Edit complete";
        }
        return redirect()->route('foods-index', ['#' . $food->id])->with('ok', $message1);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        if (app()->getLocale() == "lt") {
            $message1 = "Trynimas baigtas";
        } else {
            $message1 = "Delete complete";
        }
        $food->deletePhoto();
        $food->delete();

        return redirect()->route('foods-index', ['#' . $food->id])->with('ok', $message1);
    }
}
