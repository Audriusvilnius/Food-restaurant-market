<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\RestOrder;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\InvalidCastException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class RestOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restOrder = RestOrder::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($user) {
                $city = User::find($user->user_id);
                $user->city = $city->user_City->title;
                return $user;
            });
        // dd($restOrder);
        if (Auth::user()->role == 'user') {
            $restOrder = $restOrder
                ->where('rest_id', Auth::user()->rest_id)
                ->where('city_id', Auth::user()->city_id);
        }
        return view('back.restorder.index', [
            'restOrder' => $restOrder
        ]);
    }

    /**
     * Update status the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request   $request
     * @param  \App\Models\RestOrder  $restOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request  $request, RestOrder $order)
    {
        $to = User::find($order->user_id);
        $order_status = Order::find($request->order_id);
        if ($order->status == 0) {
            // Mail::to($to)->send(new OrderReceived($order));
            $order->status = 1;
            $order_status->status = 1;
        } elseif ($order->status == 1) {
            // Mail::to($to)->send(new OrderProcesing($order));
            $order->status = 2;
            $order_status->status = 2;
        }
        $order_status->save();
        $order->save();

        return redirect()->route('restorder-index', ['#' . $order->id]);
    }


    public function status(Request  $request, RestOrder $order)
    {
        $to = User::find($order->user_id);
        $order_status = Order::find($request->order_id);

        if ($order->status == 2) {
            // Mail::to($to)->send(new OrderCompleted($order));
            $order->status = 3;
            $order_status->status = 3;
        }
        $order_status->save();
        $order->save();

        $orders = Order::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($food) {
                $food->baskets = json_decode($food->order_json);
                return $food;
            });
        $order->ticket = $request->ticket;

        return redirect()->route('restorder-index', ['#' . $order->id]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RestOrder  $restOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(RestOrder $order)
    {
        $order->delete();
        return redirect()->route('restorder-index', ['#' . $order->id]);
    }
}