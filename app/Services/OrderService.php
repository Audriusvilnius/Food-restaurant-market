<?php

namespace App\Services;

use App\Models\Food;
use App\Models\Order;
use App\Models\RestOrder;
use Illuminate\Support\Facades\Auth;

/** @package App\Services */
class OrderService
{

    private $totals, $orders, $rest_orders, $sum, $counts;


    public function __construct()
    {
        $this->orders = session()->get('orders', []);
        $this->rest_orders = Order::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($food) {
                $food->baskets = json_decode($food->order_json);
                return $food;
            });
        foreach ($this->orders as $total) {
            $this->sum += $total->baskets->total;
        }
        $this->totals = $this->sum;
        $this->counts = $this->rest_orders->count();
    }

    public function __get($props)
    {

        return match ($props) {
            'totals' => $this->totals,
            'counts' => $this->counts,
            default => null
        };
    }


    /** @return never  */
    public function allOrder()
    {
        // $this->orders = Order::orderBy('created_at', 'desc')
        //     ->get()
        //     ->map(function ($food) {
        //         $food->baskets = json_decode($food->order_json);
        //         return $food;
        //     });
        // foreach ($this->orders as $total) {
        //     $this->sum += $total->baskets->total;
        // }
        // $this->totals = $this->sum;
        // $this->counts = $this->orders->count();
        // session()->put('orders', $this->orders);
        // return $this->total;
    }

    // public function updateOrder(array $order)
    // {
    //     session()->put('basket', $order);
    // }


    // public function deleteOrder(int $id)
    // {
    //     unset($this->basket[$id]);
    //     session()->put('basket', $this->basket);
    // }

    // public function orderRest()
    // {
    //     $order = (object)[];
    //     $order->total = $this->total;
    //     $order->baskets = [];
    //     foreach ($this->basketList as $basket) {
    //         $order->baskets[] = (object)[
    //             'title_en' => $basket->title_en,
    //             'title_lt' => $basket->title_lt,
    //             'count' => $basket->count,
    //             'price' => $basket->price,
    //             'id' => $basket->id,
    //             'status' => 0,
    //             'total' => $this->total,
    //         ];
    //     }
    //     return $order;
    // }

    // public function emptyOrder()
    // {
    //     session()->put('basket', []);
    //     $this->total = 0;
    //     $this->count = 0;
    // }
}
