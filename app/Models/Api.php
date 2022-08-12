<?php

namespace App\Models;

use App\Enums\ApiStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Api extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;

    protected $casts = [
        'status' => ApiStatus::class,
        'documentation' => 'array',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('small')
            ->width(40)
            ->height(40)
            ->sharpen(10);
    }
}
