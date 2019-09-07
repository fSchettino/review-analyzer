<?php

namespace App\Modules\Hotel;

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
        return $this->hasMany('App\Modules\Review\Review');
    }

    //each hotel belongs to many services
    public function services()
    {
        return $this->belongsToMany('App\Modules\Service\Service');
    }

    //each hotel belongs to many rules
    public function rules()
    {
        return $this->belongsToMany('App\Modules\Rule\Rule');
    }
}
