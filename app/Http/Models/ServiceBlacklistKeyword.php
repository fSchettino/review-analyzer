<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceBlacklistKeyword extends Model
{
    protected $table = 'blacklist_keywords_services';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'hotel_id',
        'blacklist_keyword_id',
    ];
}
