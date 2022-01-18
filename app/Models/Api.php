<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    protected $casts = [
        'documentation' => 'array',
    ];
}
