<?php

namespace App\Modules\Rule;

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
        return $this->belongsToMany('App\Modules\Keyword\Keyword', 'rule_keyword', 'rule_id', 'keyword_id');
    }

    //each rule has one service
    public function service()
    {
        return $this->belongsTo('App\Modules\Service\Service', 'service_id');
    }

    //each rule belongs to many hotels
    public function hotels()
    {
        return $this->belongsToMany('App\Modules\Hotel\Hotel', 'hotel_rule', 'hotel_id', 'rule_id');
    }
}
