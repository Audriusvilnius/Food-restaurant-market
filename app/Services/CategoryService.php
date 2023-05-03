<?php

namespace App\Services;

use App\Models\Category;


class CategoryService
{

    public function getCategory()
    {
        return Category::all()->sortBy('title_' . app()->getLocale());
    }
}
