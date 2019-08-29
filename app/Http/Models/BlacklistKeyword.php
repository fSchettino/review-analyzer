<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class BlacklistKeyword extends Model
{
    protected $table = 'blacklist_keywords';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'name',
        'weight',
    ];

    //each keyword belongs to many services
    public function services()
    {
        return $this->belongsToMany('App\Http\Models\Service');
    }

    //each keyword belongs to many hotels
    public function hotels()
    {
        return $this->belongsToMany('App\Http\Models\Hotel');
    }
}
