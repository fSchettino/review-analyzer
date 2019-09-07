<?php

namespace App\Modules\Shared\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRule extends Model
{
    protected $table = 'hotel_rule';
    
    protected $fillable = [
        'id',
        'hotel_id',
        'rule_id',
    ];
}
