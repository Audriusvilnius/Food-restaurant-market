<?php

namespace App\Services;

use App\Models\Food;
use App\Models\Restaurant;
use App\Models\Ovner;


class BasketService
{

    private $basket, $basketList, $total = 0, $count = 0, $dfee = 4.99, $freeshipping = [], $entries = 0, $flag = 0;


    public function __construct()
    {
        $this->basket = session()->get('basket', []);
        $ids = array_keys($this->basket);
        $this->basketList = Food::whereIn('id', $ids)

            ->get()
            ->map(function ($food) {
                $food->count = $this->basket[$food->id];
                $food->sum = $food->count * $food->price;
                $this->total += $food->sum;
                return $food;
            });
        $this->total += updatePrice($ids);
        $this->count = $this->basketList->count();
    }

    public function __get($props)
    {

        return match ($props) {
            'total' => $this->total,
            'count' => $this->count,
            'list' => $this->basketList,
            'fee' => $this->dfee,
            default => null
        };
    }


    public function add(int $id, int $count)
    {
        if (isset($this->basket[$id])) {
            $this->basket[$id] += $count;
        } else {
            $this->basket[$id] = $count;
        }
        session()->put('basket', $this->basket);
    }

    public function update(array $basket)
    {
        session()->put('basket', $basket);
    }


    public function delete(int $id)
    {
        unset($this->basket[$id]);
        session()->put('basket', $this->basket);
    }

    public function order()
    {
        $order = (object)[];
        $order->total = $this->total;
        $order->baskets = [];
        foreach ($this->basketList as $basket) {
            $order->baskets[] = (object)[
                'title_en' => $basket->title_en,
                'title_lt' => $basket->title_lt,
                'count' => $basket->count,
                'price' => $basket->price,
                'id' => $basket->id,
                'status' => 0,
                'total' => $this->total,
            ];
        }
        return $order;
    }

    public function empty()
    {
        session()->put('basket', []);
        $this->total = 0;
        $this->count = 0;
        $this->freeshipping = [];
        $this->cartList = collect();
        $this->cart = [];
    }

    public function test()
    {
        return 'Test from service';
    }

    public function delivery($data)
    {
        $this->entries++;
        $this->freeshipping[$this->entries - 1] = $data;
        $temp = 0;
        for ($i = 0; $i < $this->entries; $i++) {
            if ($data == $this->freeshipping[$i]) {
                $temp++;
            }
        };
        if ($temp < 2) {
            $this->flag = 1;
            //  $this->total += $this->dfee;  not required after fix
            // $this->total2 += $this ->dfee;   not required after fix
            return $this->dfee . ' €';
        } else {
            $this->flag = 0;
            if ((app()->getLocale() == 'lt')){
            return 'Jau įtrauktas!';
            }
            else {
                return 'Already Included!';
            }
        }
    }

    public function getFlag()
    {
        return $this->flag;
    }
}

function updatePrice($data)
{

    $names = [];
    $temp = Food::all();
    $temporary = [];

    for ($i = 0; $i < count($data); $i++) {

        $temporary[$i] = $temp->whereIn('id', $data[$i]);
        $index = $data[$i];
        $names[$i] = $temporary[$i][$index - 1]['rest_id'];
    }

    $newunique = array_unique($names);


    return count($newunique) * 4.99;
};
