<?php

namespace App\Services;

use App\Models\Food;
use App\Models\Restaurant;
use App\Models\Ovner;


class BasketService
{
    private $basket, $basketList, $total=0, $count=0;

    public function __construct()
    {
        $this->basket = session()->get('basket',[]);
        $ids = array_keys($this->basket);
        $this->basketList = Food::whereIn('id', $ids)
        ->get()
        ->map(function($food){
            $food->count=$this->basket[$food->id];
            $food->sum = $food->count*$food->price;
            $this->total += $food->sum ;
            return $food;
        });
        $this->count = $this->basketList->count(); 
    }
    
    public function __get($props)
    {
        return match($props){
            'total'=>$this->total,
            'count'=>$this->count,
            'list'=>$this->basketList,
            default=>null
        };
    }


    public function add(int $id, int $count)
    {
        if(isset($this->basket[$id])){
            $this->basket[$id] += $count;
        }else {
            $this->basket[$id] = $count;
        }
        session()->put('basket',$this->basket);
    }

        public function update(array $basket)
    {
        session()->put('basket',$basket);
    }
    

    public function delete(int $id)
    {
        unset($this->basket[$id]);
        session()->put('basket',$this->basket);
    }

    public function order()
    {
        $order = (object)[];
        $order->total = $this->total;
        $order->baskets = [];
        foreach ($this->basketList as $basket) {
          $order -> baskets[] = (object)[
            'title' => $basket->title,
            'count'=> $basket->count,
            'price'=> $basket->price,
            'id'=> $basket->id,
            'status'=> 0,
            'total'=>$this->total,
          ];
        }
        return $order;
    }

    public function empty()
    {
        session()->put('basket', []);
        $this->total = 0;
        $this->count = 0;
        $this->cartList = collect();
        $this->cart = [];
    }

    public function test()
    {
        return 'Test from service';
    }   
 
}