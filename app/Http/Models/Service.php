<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'service';
    
    protected $fillable = [
        'id',
        'name',
    ];

    //each service belongs to many hotels
    public function hotels()
    {
        return $this->belongsToMany('App\Http\Models\Hotel');
    }

    //each service has many rules
    public function rules()
    {
        return $this->hasMany('App\Http\Models\Rule');
    }
}
