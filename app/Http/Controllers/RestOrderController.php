<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RestOrder;
use App\Models\User;

class RestOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // dump($restOrder);

        $restOrder = RestOrder::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($user) {
                $city = User::find($user->user_id);
                $user->city = $city->user_City->title;
                return $user;
            });
        return view('back.restorder.index', [
            'restOrder' => $restOrder
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request   $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request  $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RestOrder  $restOrder
     * @return \Illuminate\Http\Response
     */
    public function show(RestOrder $restOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RestOrder  $restOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(RestOrder $restOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request   $request
     * @param  \App\Models\RestOrder  $restOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request  $request, RestOrder $restOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RestOrder  $restOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(RestOrder $restOrder)
    {
        //
    }
}
