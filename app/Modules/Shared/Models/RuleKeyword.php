<?php

namespace App\Modules\Shared\Models;

use Illuminate\Database\Eloquent\Model;

class RuleKeyword extends Model
{
    protected $table = 'rule_keyword';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'rule_id',
        'keyword_id',
    ];
}
