<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class HotelService extends Model
{
    protected $table = 'hotels_services';
    
    protected $fillable = [
        'id',
        'hotel_id',
        'service_id',
    ];
}
