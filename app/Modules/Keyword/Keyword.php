<?php

namespace App\Modules\Keyword;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $table = 'keyword';
    
    protected $fillable = [
        'id',
        'type',
        'name',
        'weight',
    ];

    //each keyword belongs to many rules
    public function rules()
    {
        return $this->belongsToMany('App\Modules\Rule\Rule', 'rule_keyword', 'rule_id', 'keyword_id');
    }
}
