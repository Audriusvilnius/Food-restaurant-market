<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ovner;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OvnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ovners=Ovner::all()->sortBy('title');
        return view('back.ovner.index',[
            'ovners'=> $ovners
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ovners=Ovner::all()->sortBy('title');
            return view('back.ovner.create',[
            'ovners'=> $ovners,
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
            'ovner_title' => 'required|nullable',   
            'ovner_country' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'ovner_city' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'ovner_postcode' => 'required|nullable',
            'ovner_build' => 'required|nullable',
            'ovner_phone' => 'required|nullable',
            'ovner_email' => 'required|email:rfc,dns',
            'ovner_url' => 'required|url',
        ]);
        // 'ovner_build' => 'required|alpha|min:5|max:100',
        // 'ovner_bank' => 'required|alpha|min:4|max:100',
        // 'ovner_account' => 'required|alpha|min:4|max:100',
        // 'ovner_mobile' => 'required|numeric|min:1|max:9999999999999',
        // 'ovner_add' => 'required|alpha|min:4|max:100',
        // 'ovner_des' => 'required|alpha|min:4|max:100',            
        // 'drink_title' => 'required|alpha|min:3|max:100|regex:/^T/',
        // 'drink_size' => 'required|min:1|max:9999',
        // 'drink_price' => 'required|decimal:0,2|min:0|max:999',
        // 'type_id' => 'required|numeric|min:1',



        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }


        $ovner = new Ovner;

        if($request->file('photo')){
            $photo = $request->file('photo');
            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);            
            $file = $name.'-'.time().'.'.$ext;
            $photo->move(public_path().'/images',$file);
            $ovner->photo='/'.'images/'.$file;
        }else{
            $ovner->photo='/images/temp/noimage.jpg';
        }
        $ovner->title=$request->ovner_title;
        $ovner->street=$request->ovner_street;
        $ovner->country=$request->ovner_country;
        $ovner->city=$request->ovner_city;
        $ovner->postcode=$request->ovner_postcode;
        $ovner->phone=$request->ovner_phone;
        $ovner->mobile=$request->ovner_mobile;
        $ovner->email=$request->ovner_email;
        $ovner->url=$request->ovner_url;
        $ovner->account=$request->ovner_account;
        $ovner->bank=$request->ovner_bank;
        $ovner->open=$request->ovner_open;
        $ovner->close=$request->ovner_close;
        $ovner->add=$request->ovner_add;
        $ovner->des=$request->ovner_des;
        $ovner->save();

        return redirect()->route('ovner-index');  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ovner  $ovner
     * @return \Illuminate\Http\Response
     */
    public function show(Ovner $ovner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ovner  $ovner
     * @return \Illuminate\Http\Response
     */
    public function edit(Ovner $ovner)
    {
        return view('back.ovner.edit',[
        'ovner'=> $ovner,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Ovner  $ovner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ovner $ovner)
    {
        if($request->delete_photo){
        $ovner->deletePhoto();
        return redirect()->back()->with('ok', 'Photo deleted');}
        
        $validator = Validator::make(
            $request->all(),
            [
            'ovner_title' => 'required|nullable',
            'ovner_country' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'ovner_city' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'ovner_postcode' => 'required|nullable',
            'ovner_build' => 'required|nullable',
            'ovner_phone' => 'required|nullable',
            'ovner_email' => 'required|email:rfc,dns',
            'ovner_url' => 'required|url',
        ]);
        // 'ovner_close' => 'required|date_format:H:i|after:ovner_open',
        // 'ovner_open' => 'required|date_format:H:i',
        // 'ovner_bank' => 'required|alpha|min:4|max:100',
        // 'ovner_account' => 'required|alpha|min:4|max:100',
        // 'ovner_mobile' => 'required|numeric|min:1|max:9999999999999',
        // 'ovner_add' => 'required|alpha|min:4|max:100',
        // 'ovner_des' => 'required|alpha|min:4|max:100',            
        // 'drink_title' => 'required|alpha|min:3|max:100|regex:/^T/',
        // 'drink_size' => 'required|min:1|max:9999',
        // 'drink_price' => 'required|decimal:0,2|min:0|max:999',
        // 'type_id' => 'required|numeric|min:1',
        // 'drink_vol' => 'sometimes|decimal:0,1|min:1|max:99',


            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }


        if($request->file('photo')){
            $photo = $request->file('photo');
            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);            
            $file = $name.'-'.time().'.'.$ext;
 
        if($ovner->photo){
                $ovner->deletePhoto();
            }
        
            $photo->move(public_path().'/images',$file);
            //$country->photo=asset('/images').'/'.$file;
            $ovner->photo='/'.'images/'.$file;
        }
        $ovner->title=$request->ovner_title;
        $ovner->street=$request->ovner_street;
        $ovner->city=$request->ovner_city;
        $ovner->country=$request->ovner_country;
        $ovner->postcode=$request->ovner_postcode;
        $ovner->phone=$request->ovner_phone;
        $ovner->mobile=$request->ovner_mobile;
        $ovner->email=$request->ovner_email;
        $ovner->url=$request->ovner_url;
        $ovner->account=$request->ovner_account;
        $ovner->bank=$request->ovner_bank;
        $ovner->open=$request->ovner_open;
        $ovner->close=$request->ovner_close;
        $ovner->add=$request->ovner_add;
        $ovner->des=$request->ovner_des;
        $ovner->save();
return redirect()->route('ovner-index')->with('ok', 'Update complete');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ovner  $ovner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ovner $ovner)
    {
        $ovner->deletePhoto();
        $ovner->delete();
        return redirect()->route('ovner-index')->with('ok', 'Delete complete');  
    }
}