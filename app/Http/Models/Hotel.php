<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hotels';
    
    protected $fillable = [
        'id',
        'name',
        'description',
        'rooms',
        'score',
    ];

    //each hotel has many reviews
    public function reviews()
    {
        return $this->hasMany('App\Http\Models\HotelReview');
    }

    //each hotel belongs to many services
    public function services()
    {
        return $this->belongsToMany('App\Http\Models\Service');
    }
}
