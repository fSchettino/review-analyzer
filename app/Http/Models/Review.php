<?php

namespace App\Http\Models;

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
}
