<?php

namespace App\Models;

use App\Enums\ApiStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Api extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;

    protected $casts = [
        'status' => ApiStatus::class,
        'documentation' => 'array',
    ];
}
