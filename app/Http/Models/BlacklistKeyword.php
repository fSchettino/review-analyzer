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
}
