<?php

namespace App\Services;

use App\Models\Food;
use App\Models\RestOrder;


/** @package App\Services */
class OrderService
{

    private $order, $basketList, $total = 0, $count = 0;


    // public function __construct()
    // {
    //     $this->order = session()->get('Order', []);
    //     $ids = array_keys($this->basket);
    //     $this->basketList = Food::whereIn('id', $ids)
    //         ->get()
    //         ->map(function ($food) {
    //             $food->count = $this->basket[$food->id];
    //             $food->sum = $food->count * $food->price;
    //             $this->total += $food->sum;
    //             return $food;
    //         });
    //     $this->total += updatePrice($ids);
    //     $this->count = $this->basketList->count();
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


    // public function addOrder(int $id, int $count)
    // {
    //     if (isset($this->basket[$id])) {
    //         $this->order[$id] += $count;
    //     } else {
    //         $this->order[$id] = $count;
    //     }
    //     session()->put('basket', $this->basket);
    // }

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
        return 'Test from Order service';
    }
}
