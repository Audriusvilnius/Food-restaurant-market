<?php

namespace App\Http\Controllers;

//use App\Http\Requests\Request;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants=Restaurant::all();
        return view('back.restaurants.index',[
            'restaurants'=> $restaurants
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.restaurants.create');
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
            'restaurant_title' => 'required|nullable',
            'restaurant_city' => 'required|nullable',
            'restaurant_addres' => 'required|nullable',
            'photo' => 'required|nullable',
        ]);

            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }

        $restaurant = new Restaurant;

        if($request->file('photo')){
            $photo = $request->file('photo');
            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);            
            $file = $name.'-'.time().'.'.$ext;
            $photo->move(public_path().'/images',$file);
            $restaurant->photo='/'.'images/'.$file;
        }else{
            $restaurant->photo='/images/temp/noimage.jpg';
        }

        $restaurant->title=$request->restaurant_title;
        $restaurant->city=$request->restaurant_city;
        $restaurant->addres=$request->restaurant_addres;
        $restaurant->open=$request->restaurant_open;
        $restaurant->close=$request->restaurant_close;
        $restaurant->des=$request->restaurant_add;
        $restaurant->des=$request->restaurant_des;
        $restaurant->save();

        return redirect()->route('restaurants-index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        return view('back.restaurants.edit',[
            'restaurant'=> $restaurant
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        if($request->delete_photo){
        $restaurant->deletePhoto();
        return redirect()->back()->with('ok', 'Photo deleted');}

        $validator = Validator::make(
            $request->all(),
            [
            'restaurant_title' => 'required|nullable',
            'restaurant_city' => 'required|nullable',
            'restaurant_addres' => 'required|nullable',
            'photo' => 'required|nullable',
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
 
        if($restaurant->photo){
                $restaurant->deletePhoto();
            }
        
            $photo->move(public_path().'/images',$file);
            //$country->photo=asset('/images').'/'.$file;
            $restaurant->photo='/'.'images/'.$file;
        }

        $restaurant->title=$request->restaurant_title;
        $restaurant->city=$request->restaurant_city;
        $restaurant->addres=$request->restaurant_addres;
        $restaurant->open=$request->restaurant_open;
        $restaurant->close=$request->restaurant_close;
        $restaurant->des=$request->restaurant_des;

        $restaurant->save();
        
        return redirect()->route('restaurants-index', ['#'.$restaurant->id])->with('ok', 'Edit complete');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        if(!$restaurant->food_Restaurant()->count()){
            $restaurant->deletePhoto();
            $restaurant->delete();
        return redirect()->route('restaurants-index', ['#'.$restaurant->id])->with('ok', 'Delete complete');
        }else{
            return redirect()->route('restaurants-index', ['#'.$restaurant->id])->with('not', ' Can\'t Delete Restaurants, firs delete food from restaurant');
        }
    }
}