<?php

namespace App\Modules\Review;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';
    
    protected $fillable = [
        'id',
        'hotel_id',
        'title',
        'description',
        'score',
    ];

    //each review belongs to a hotel
    public function hotel()
    {
        return $this->belongsTo('App\Modules\Hotel\Hotel');
    }
}
