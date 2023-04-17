<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

        public function food_Category()

    {
        return $this->hasMany(City::class, 'food_category_no','id');
    }
}