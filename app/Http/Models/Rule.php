<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $table = 'rule';
    
    protected $fillable = [
        'id',
        'service_id',
        'name',
    ];

    //each rule belongs to many keywords
    public function keywords()
    {
        return $this->belongsToMany('App\Http\Models\Keyword', 'rule_keyword', 'rule_id', 'keyword_id');
    }

    //each rule has one service
    public function service()
    {
        return $this->belongsTo('App\Http\Models\Service', 'service_id');
    }
}
