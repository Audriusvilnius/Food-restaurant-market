<?php

namespace App\Services;


use App\Models\Restaurant;
use App\Models\Food;
use App\Models\Category;
use App\Models\City;



class CityService
{
   
    public function getCity()
    {
    return City::all()->sortBy('title');
    }
      
}