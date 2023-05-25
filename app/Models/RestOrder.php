<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RestOrder extends Model
{
    use HasFactory;
    /** @return BelongsTo  */
    public function rest_Order_rest()
    {
        return $this->belongsTo(Restaurant::class, 'rest_id', 'id');
    }
    /** @return BelongsTo  */
    public function rest_Order_food()
    {
        return $this->belongsTo(Food::class, 'food_id', 'id');
    }
    /** @return BelongsTo  */
    public function rest_Order_City()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    /** @return BelongsTo  */
    public function user_rest_Order()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    // public function user_food_Order()
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'rest_id');
    // }
}
