<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceReview extends Model
{
    protected $table = 'service_reviews';
    
    protected $fillable = [
        'id',
        'service_id',
        'title',
        'description',
        'score',
    ];
}
