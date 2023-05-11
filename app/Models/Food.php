<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    const SORT = [
        'asc_price' => 'Price A-Z',
        'desc_price' => 'Price Z-A',
        'asc_name' => 'Title A-Z',
        'desc_name' => 'Title Z-A',
        'desc_rate' => 'Rating',
    ];

    const SORT_LT = [
        'asc_price' => 'Kaina A-Ž',
        'desc_price' => 'Kaina Ž-A',
        'asc_name' => 'Vardas A-Ž',
        'desc_name' => 'Vardas Ž-A',
        'desc_rate' => 'Įvertis',
    ];
    const PER_PAGE = [
        6, 12, 24, 48, 'All',
    ];
    const PER_PAGE_LT = [
        6, 12, 24, 48, 'Visi',
    ];

    public function foodReataurants_name()
    {
        return $this->belongsTo(Restaurant::class, 'rest_id', 'id');
    }

    public function foodCities_no()
    {
        return $this->belongsTo(City::class, 'food_city_no', 'id');
    }

    public function foodCategory_no()
    {
        return $this->belongsTo(Category::class, 'food_category_no', 'id');
    }


    public function deletePhoto()
    {
        $fileName = $this->photo;
        if (file_exists(public_path() . $fileName) && $fileName != '/images/temp/noimage.jpg') {
            unlink(public_path() . $fileName);
            $this->photo = '/images/temp/noimage.jpg';
        }
        $this->save();
    }
}
