<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class HotelReview extends Model
{
    protected $table = 'hotel_reviews';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'hotel_id',
        'title',
        'description',
        'score',
    ];
}
