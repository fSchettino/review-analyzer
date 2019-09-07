<?php

namespace App\Modules\Service;

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
        return $this->belongsToMany('App\Modules\Hotel\Hotel');
    }

    //each service has many rules
    public function rules()
    {
        return $this->hasMany('App\Modules\Rule\Rule');
    }
}
