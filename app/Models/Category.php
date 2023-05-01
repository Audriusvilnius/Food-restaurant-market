<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function food_Category()
    {
        return $this->hasMany(Food::class, 'food_category_no', 'id');
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
