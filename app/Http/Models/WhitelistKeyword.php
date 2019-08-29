<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class WhitelistKeyword extends Model
{
    protected $table = 'whitelist_keywords';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'name',
        'weight',
    ];
}
