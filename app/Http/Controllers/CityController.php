<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Food;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities=City::all()->sortBy('title');
        $foods = Food::orderBy('created_at', 'desc')->get();

        return view('back.city.index',[
            'cities'=> $cities,
            'foods'=> $foods,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities=City::all()->sortBy('title');

        return view('back.city.create',[
            'cities'=> $cities,
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
                'city_title' => 'required|nullable|unique:cities,title',
            ]);
            
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
        $city = new City;
    
        $city->title=$request->city_title;
        $city->save();
        return redirect()->route('city-index');  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {

        $cities=City::all()->sortBy('title');
        return view('back.city.edit',[
            'city'=> $city,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
            $validator = Validator::make(
            $request->all(),
            [
                'city_title' => 'required|nullable|unique:cities,title',
            ]);
            
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
        $city->title=$request->city_title;
        $city->save();
        return redirect()->route('city-index', ['#'.$city->id])->with('ok', 'Edit complete');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        if(!$city->food_City()->count()){
            $city->delete();
        return redirect()->route('city-index', ['#'.$city->id])->with('ok', 'Delete complete');
        }else{
            return redirect()->route('city-index', ['#'.$city->id])->with('not', ' Can\'t Delete city, firs delete food from city');
        }
    }
}