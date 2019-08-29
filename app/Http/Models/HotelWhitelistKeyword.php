<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class HotelWhitelistKeyword extends Model
{
    protected $table = 'hotels_whitelist_keywords';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'hotel_id',
        'whitelist_keyword_id',
    ];
}
