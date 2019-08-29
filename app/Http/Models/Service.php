<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'name',
        'score',
    ];
}
