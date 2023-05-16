<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Ovner;
use App\Mail\OrderBasket;
use App\Mail\OrderShipped;
use App\Mail\OrderProcesing;
use App\Mail\OrderCompleted;
use App\Mail\OrderReceived;
use App\Models\Food;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Mail;
use LogicException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($food) {
                $food->baskets = json_decode($food->order_json);
                return $food;
            });
        if (Auth::user()->role == 'user') {
            $orders = Order::orderBy('created_at', 'desc')
                ->get()
                ->map(function ($food) {
                    $food->baskets = json_decode($food->order_json);
                    $food->data = [];
                    foreach ($food->baskets->baskets as $key => $basket) {
                        $food->count = $basket->count;
                        $food->food_id = $basket->id;
                        $food_id = Food::find($food->food_id);
                        $food->rest_title = $basket->id;
                        // $food->rest_id = $food_id->rest_title;
                        $food->title_lt = $food_id->title_lt;
                        $food->title_en = $food_id->title_en;
                        $food->price = $food_id->price;
                        $food->data += [$key => [
                            'id' => $food->food_id,
                            'rest_id' => $food->rest_id,
                            // 'rest_title' => $food->rest_title,
                            'title_lt' => $food->title_lt,
                            'title_en' => $food->title_en,
                            'qty' => $food->count,
                            'price' => $food->price,
                        ]];
                    }
                    return $food;
                });
            foreach ($orders as $data) {
                dump($data->data);
            }
        }

        return view('back.orders.index', [
            'orders' => $orders
        ]);
    }

    public function myorders()
    {
        $orders = Order::orderBy('created_at', 'desc')
            ->where('user_id', Auth::user()->id)
            ->get()
            ->map(function ($food) {
                $food->baskets = json_decode($food->order_json);
                return $food;
            });
        return view('back.orders.myorders', [
            'orders' => $orders
        ]);
    }



    public function update(Request $request, Order $order)
    {
        $to = User::find($order->user_id);
        if ($order->status == 0) {
            // Mail::to($to)->send(new OrderReceived($order));
            $order->status = 1;
            $order->save();
        } elseif ($order->status == 1) {
            // Mail::to($to)->send(new OrderProcesing($order));
            $order->status = 2;
            $order->save();
        }

        return redirect()->route('order-index', ['#' . $order->id]);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('order-index', ['#' . $order->id]);
    }

    public function status(Request $request, Order $order)
    {
        $to = User::find($order->user_id);
        if ($order->status == 2) {
            // Mail::to($to)->send(new OrderCompleted($order));
            $order->status = 3;
            $order->save();
        }

        $orders = Order::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($food) {
                $food->baskets = json_decode($food->order_json);
                return $food;
            });
        $order->ticket = $request->ticket;

        return view('back.orders.index', [
            'orders' => $orders
        ]);
    }

    public function shiped(Request $request, Order $order)
    {
        $orders = Order::orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($food) {
                $food->baskets = json_decode($food->order_json);
                return $food;
            });
        return view('back.orders.ticket', [
            'orders' => $orders
        ]);
    }
}