<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class HotelReview extends Model
{
    protected $table = 'hotel_reviews';
    
    protected $fillable = [
        'id',
        'hotel_id',
        'title',
        'description',
        'score',
    ];
}
