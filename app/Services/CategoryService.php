<?php

namespace App\Services;


use App\Models\Restaurant;
use App\Models\Food;
use App\Models\Category;



class CategoryService
{
   
    public function getCategory()
    {
        
    return Category::all()->sortBy('title');
    }
      
}