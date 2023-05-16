<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    public function food_City()

    {
        return $this->hasMany(Food::class, 'food_city_no', 'id');
    }
}
