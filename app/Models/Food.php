<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    const SORT = [
        'asc_price'=>'Price A-Z',
        'dessc_price'=>'Price Z-A',
        'asc_name'=> 'Title A-Z',
        'desc_name'=>'Title Z-A',
        'desc_rate'=>'Rating',
    ];
    const PER_PAGE = [
        6 , 12, 24, 48,'All',
    ];

    public function foodReataurants_name()
    {
        return $this->belongsTo(Restaurant::class, 'rest_id','id');
    }

    public function deletePhoto()
    {
        $fileName = $this->photo;
        if(file_exists(public_path().$fileName) && $fileName!='/images/temp/noimage.jpg'){
            unlink(public_path().$fileName);
            $this->photo='/images/temp/noimage.jpg';
        }
        $this->save();
    }
}