<?php

namespace App\Modules\Shared\Models;

use Illuminate\Database\Eloquent\Model;

class HotelService extends Model
{
    protected $table = 'hotel_service';
    
    protected $fillable = [
        'id',
        'hotel_id',
        'service_id',
    ];
}
