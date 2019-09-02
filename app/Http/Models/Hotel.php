<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hotel';
    
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
        return $this->hasMany('App\Http\Models\Review');
    }

    //each hotel belongs to many services
    public function services()
    {
        return $this->belongsToMany('App\Http\Models\Service');
    }

    //each hotel belongs to many rules
    public function rules()
    {
        return $this->belongsToMany('App\Http\Models\Rule');
    }
}
