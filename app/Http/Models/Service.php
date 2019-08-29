<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'name',
        'score',
    ];

    //each service has many reviews
    public function reviews()
    {
        return $this->hasMany('App\Http\Models\ServiceReview');
    }

    //each service belongs to many hotels
    public function hotels()
    {
        return $this->belongsToMany('App\Http\Models\Hotel');
    }
}
