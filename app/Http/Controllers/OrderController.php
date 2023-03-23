<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Ovner;
use App\Models\User;
use App\Mail\OrderReceived;
use Illuminate\Support\Facades\Mail;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')
        ->get()
        ->map(function($food){
            $food->baskets =json_decode($food->order_json);
            return $food;
        });
        return view('back.orders.index',[
            'orders'=>$orders
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
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->status=1;
        $order->save();
        $to = User::find($order->user_id);
        Mail::to($to)->send(new OrderReceived($order));

        return redirect()->route('order-index', ['#'.$order->id]);
        //redirect()->route('index', ['#'.$order->id])
    }
            public function ticket(Request $request, Order $order)
    {

        // $to = User::find($order->user_id);
        // Mail::to($to)->send(new OrderComplete($order));
        $order->status=2;
        $order->save();
        $order = Order::where('id','=',$request->ticket)
        ->get()
        ->map(function($food){
            $food->baskets =json_decode($food->order_json);
            return $food;
        });
        $order->ticket=$request->ticket;

    
        return view('back.orders.ticket',[
          'order'=>$order
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('order-index', ['#'.$order->id]);
    }
}