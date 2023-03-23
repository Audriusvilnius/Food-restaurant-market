<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Food;
use App\Models\Restaurant;
use App\Models\Front;
use App\Models\Order;
use App\Models\Ovner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Services\BasketService;
use App\Mail\OrderBasket;
use App\Mail\OrderShipped;
use App\Mail\OrderCompleted;
use App\Mail\OrderReceived;
use Illuminate\Support\Facades\Mail;

// use Illuminate\Support\Facades\Hash;

class FrontController extends Controller
{
      
    public function home(Request $request)
    {
        $ovners=Ovner::all()->sortBy('title');

        $foods=Food::all()->sortBy('title');

        $restaurants=Restaurant::all()->sortBy('title');

        $perPageShow = in_array($request->per_page, Food::PER_PAGE) ? $request->per_page : 'All';
        
        
        if (!$request->s){

            if($request->restaurant_id && $request->restaurant_id != 'all'){
            $foods = Food::where('rest_id', $request->restaurant_id);
            }else {
            $foods = Food::where('id', '>', 0);}
            
        $foods=match($request->sort ?? ''){
            'asc_price'=>$foods->orderBy('price'),
            'dessc_price'=>$foods->orderBy('price', 'desc'),
            'asc_name'=>$foods->orderBy('title'),
            'desc_name'=>$foods->orderBy('title', 'desc'),
            'desc_rate'=>$foods->orderBy('rating', 'desc'),
            // 'desc_rest'=>Food::orderBy('title'),
            default =>$foods
          };
        if ($perPageShow =='All'){
            $foods= $foods->get();
        }
        else{
            $foods= $foods->paginate($perPageShow)->withQueryString();}
        }
        else{
            $s = explode(' ', $request->s);
            if ( count($s) == 1) {
                $foods = Food::where('title', 'like', '%'.$request->s.'%')
                ->orWhere('rest_title', 'like', '%'.$request->s.'%')
                ->orWhere('price', 'like', '%'.$request->s.'%')
                ->get();
            }
            else {
                 $foods = Food::where('title', 'like', '%'.$s[0].'%'.$s[1].'%')
                ->orWhere('title', 'like', '%'.$s[1].'%'.$s[0].'%')
                ->orWhere('rest_title', 'like', '%'.$s[1].'%'.$s[0].'%')
                ->orWhere('rest_title', 'like', '%'.$s[0].'%'.$s[1].'%')
                ->get();
            }
        }

        $faker = Faker::create();
        $text1 = $faker->realText(600,5);
        $text2 = $faker->realText(500,5);
        $text3 = $faker->realText(20,2);

        return view('front.home.home',[
            'foods'=> $foods,
            'restaurants'=>$restaurants,
            'ovners'=>$ovners,
            'text1' => $text1,
            'text2' => $text2,
            'text3' => $text3,
            'sortSelect' => Food::SORT,
            'sortShow' => isset(Food::SORT[$request->sort]) ? $request->sort : '',
            'perPageSelect' => Food::PER_PAGE,
            'perPageShow' => in_array($request->per_page, Food::PER_PAGE) ? $request->per_page : 'All',
            'typeShow'=>$request->restaurant_id ? $request->restaurant_id :'',
            's' => $request->s ?? ''
        ]);
    }

    public function rate(Request $request, Food $food)
    {  
        $foo = Food::where('id','=', $request->product)->first();
        
        $rate=json_decode($foo->rating_json,1);
        
        $request->user_id = Auth::user()->id;
        
        if($rate){
            $rate[$request->user_id]=$request->rate;  
        }else{ 
            $rate = [$request->user_id=> $request->rate];
        }  

        $rating=array_sum($rate)/count($rate);
        $counts=count($rate);
        
        $rate=json_encode($rate);

        DB::table('food')->where('id', $request->product) ->update([ 'rating_json' => $rate]);
        DB::table('food')->where('id', $request->product) ->update([ 'rating' => $rating]);
        DB::table('food')->where('id', $request->product) ->update([ 'counts' => $counts]);

        return redirect(url()->previous().'#'.$request->product)->with('ok', 'You rate '.$foo->title.' '.$request->rate. ' points');
    }

    public function addToBasket(Request $request, Food $food, BasketService $basket)
    {
        $id = (int)$request->id;
        $count = (int)$request->count;
        $basket->add($id, $count);

        return redirect(url()->previous().'#'.$request->id)->with('ok', 'Add to basket succses');
    }

    public function viewBasket(Request $request, BasketService $basket)
    {
        $ovners=Ovner::all();
       
        // $restaurants=Restaurant::all()->sortBy('title');
        $faker = Faker::create();
        $text1 = $faker->realText(600,5);
        $text2 = $faker->realText(500,5);
        $text3 = $faker->realText(20,2);

        
        return view('front.home.basket',[
            'basketList'=>$basket->list,
            'ovners'=>$ovners,
            'text1' => $text1,
            'text2' => $text2,
            'text3' => $text3,
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
        return redirect(url()->previous().'#'.$request->id)->with('ok', 'Update complete');
    }   
    
    public function makeOrder(Request $request,  BasketService $basket)
    {
        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->basket_json=json_encode($basket->order());
        $order->order_json=json_encode($basket->order());
        $order->save();

        $to = User::find($order->user_id);
        Mail::to($to)->send(new OrderReceived($order));

        $basket->empty();
     
        return redirect()->route('start'); 
    }

    
    public function listRestaurants(Request $request, Restaurant $restaurant)
    {
        $ovners=Ovner::all()->sortBy('title');

        $restaurants=Restaurant::all();

        $foods=Food::where('rest_id',$restaurant->id)->get();  
        $foods=$foods->sortBy('title');
       
        $faker = Faker::create();
        $text1 = $faker->realText(600,5);
        $text2 = $faker->realText(500,5);
        $text3 = $faker->realText(20,2);

        return view('front.home.home',[
            'restaurants'=>$restaurants,
            'foods'=> $foods,
            'ovners'=> $ovners,
            'text1' => $text1,
            'text2' => $text2,
            'text3' => $text3,
            'sortSelect' => Food::SORT,
            'sortShow' => isset(Food::SORT[$request->sort]) ? $request->sort : '',
            'perPageSelect' => Food::PER_PAGE,
            'perPageShow' => in_array($request->per_page, Food::PER_PAGE) ? $request->per_page : 'All',
            'typeShow'=>$request->restaurant_id ? $request->restaurant_id :'',
            's' => $request->s ?? ''
        ]);
    } 
}