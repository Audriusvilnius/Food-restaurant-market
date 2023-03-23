<?php

namespace App\Http\Controllers;

// use App\Http\Requests\Request;
use App\Models\Food;
use Illuminate\Support\Facades\DB;
use App\Models\Restaurant;
use Illuminate\Http\Request;
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
       //$foods=Food::all()->sortBy('title');
        $foods = Food::orderBy('created_at', 'desc')->get();
        return view('back.food.index',[
            'foods'=> $foods
        ]);
    }
    public function copyRestTitle()
    {
        $foods=food::all();
        foreach ($foods as $food) {
        $foo=Restaurant::where('id','=', $food->rest_id)->first();
        $food->rest_title=$foo->title;
        $food->save();
        }
        return redirect()->back()->with('ok', 'Rrestaurant title copy succses');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function create()
        {
            $restaurants=Restaurant::all()->sortBy('title');
            return view('back.food.create',[
            'restaurants'=> $restaurants
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
            'food_title' => 'required|nullable',
            'food_price' => 'required|decimal:0,2|min:0|max:999',
            'photo' => 'required|nullable',
        ]);

            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }

        $food = new Food;

        if($request->file('photo')){
        $photo = $request->file('photo');
        $ext = $photo->getClientOriginalExtension();
        $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);            
        $file = $name.'-'.time().'.'.$ext;
        $photo->move(public_path().'/images',$file);
        $food->photo='/'.'images/'.$file;
        }else{
        $food->photo='/images/temp/noimage.jpg';
        }
        
        $food->rest_id=$request->restaurant_id;

        $foo=Restaurant::where('id','=', $food->rest_id)->first();
        $food->rest_title=$foo->title;
        
        $food->title=$request->food_title;
        $food->price=$request->food_price;
        $food->des=$request->food_des;
        $food->add=$request->food_add;
        $food->rating=0;
        $food->counts=0;
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
        return view('back.food.index',[
            'food'=> $food
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
        $restaurants=Restaurant::all()->sortBy('title');
            return view('back.food.edit',[
            'food'=> $food,
            'restaurants'=> $restaurants
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
        if($request->delete_photo){
            $food->deletePhoto();
        return redirect()->back()->with('ok', 'Photo deleted');
        }

        $validator = Validator::make(
            $request->all(),
            [
            'food_title' => 'required|nullable',
            'food_price' => 'required|decimal:0,2|min:0|max:999',
            // 'photo' => 'required|nullable',
        ]);

            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
   

        if($request->file('photo')){
            $photo = $request->file('photo');
            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);            
            $file = $name.'-'.time().'.'.$ext;
 
        if($food->photo){
            $food->deletePhoto();
            }
        
            $photo->move(public_path().'/images',$file);
            //$country->photo=asset('/images').'/'.$file;
            $food->photo='/'.'images/'.$file;
        }
        
        $food->title=$request->food_title;
        $food->price=$request->food_price;

        $food->rest_id=$request->restaurant_id;
        $foo=Restaurant::where('id','=', $food->rest_id)->first();
        $food->rest_title=$foo->title;
       
        $food->des=$request->food_des;
        $food->add=$request->food_add;
        
        $food->save();

        return redirect()->route('foods-index', ['#'.$food->id])->with('ok', 'Edit complete');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        $food->deletePhoto();
        $food->delete();
        return redirect()->route('foods-index', ['#'.$food->id])->with('ok', 'Delete complete');
    }
}