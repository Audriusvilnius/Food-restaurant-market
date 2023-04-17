<?php

namespace App\Services;


use App\Models\Restaurant;
use App\Models\Food;
use App\Models\Category;



class CategoryService
{
   
    public function getService()
    {
    return Category::all()->sortBy('title');
    }
    
        public function testRes()
    {
        return 'Test from Category service';
    }   
}