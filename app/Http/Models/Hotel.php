<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hotels';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'name',
        'description',
        'rooms',
        'score',
    ];
}
