<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceWhitelistKeyword extends Model
{
    protected $table = 'services_whitelist_keywords';
    
    protected $fillable = [
        'id',
        'service_id',
        'whitelist_keyword_id',
    ];
}
