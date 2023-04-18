<?php

namespace App\Services;


use App\Models\Restaurant;
use App\Models\Food;


class RestaurantService
{
   
    public function getService()
    {
    return Restaurant::all()->sortBy('city');
    }
    
        public function testRes()
    {
        return 'Test from Restaurant service';
    }   
}