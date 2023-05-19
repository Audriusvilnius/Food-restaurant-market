<?php

namespace App\Services;

use App\Models\Food;
use App\Models\Order;
use App\Models\RestOrder;


/** @package App\Services */
class OrderService
{

    private $restOrder, $orders, $countOrder = 0, $count = 0;


    // public function __construct()
    // {
    //     $this->restOrder = rest_Order()->count();
    // }

    // public function __get($props)
    // {

    //     return match ($props) {
    //         'total' => $this->total,
    //         'count' => $this->count,
    //         'list' => $this->basketList,
    //         'fee' => $this->dfee,
    //         default => null
    //     };
    // }


    /** @return never  */
    public function allOrder()
    {
        $this->orders = Order::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($food) {
                $food->baskets = json_decode($food->order_json);
                return $food;
            });
        foreach ($this->orders as $_) {
            $this->restOrder++;
        }
        $orders = $this->restOrder++;
        // dump($this->orders);
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

    public function testOrder()
    {
        $this->restOrder = 'Test from Order service';
        return $this->restOrder;
    }
}
