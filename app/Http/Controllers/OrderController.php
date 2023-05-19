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
use App\Services\BasketService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Mail;
use LogicException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\map;

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
        if (!$order->rest_Order()->count()) {
            $order->delete();
            return redirect()->route('order-index', ['#' . $order->id])->with('ok', 'Order was delet');
        } else {
            $countOrder = $order->rest_Order()->count();
            return redirect()->back()->with('not', 'Can,t delet order. User have open ' . $countOrder . ' offer. ');
        }
    }

    public function status(Request $request, Order $order)
    {
        $to = User::find($order->id);
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
        return redirect()->route('order-index', ['#' . $order->id]);
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
