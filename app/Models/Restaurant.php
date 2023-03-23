<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    
    public function food_Restaurant()
    {
        return $this->hasMany(Food::class, 'rest_id', 'id');
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