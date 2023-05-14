<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    // use HasApiTokens, HasFactory, Notifiable;
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    const ROLES = [
        'A' => 'admin',
        'M' => 'manager',
        'C' => 'customer'
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** @return BelongsTo  */
    public function user_City()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    /** @return BelongsTo  */
    public function user_Restaurants()
    {
        return $this->belongsTo(Restaurant::class, 'rest_id', 'id');
    }
}
