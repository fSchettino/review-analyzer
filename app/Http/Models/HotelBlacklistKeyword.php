<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class HotelBlacklistKeyword extends Model
{
    protected $table = 'blacklist_keywords_hotels';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'hotel_id',
        'blacklist_keyword_id',
    ];
}
