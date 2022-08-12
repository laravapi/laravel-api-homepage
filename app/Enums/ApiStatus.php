<?php

namespace App\Enums;

enum ApiStatus: string
{
    case SUBMITTED = 'submitted';
    case IN_EVALUATION = 'in-evaluation';
    case PUBLISHED = 'published';

    public static function asArray()
    {
        $values = array_map(fn($status) => $status->value, self::cases());
        return array_combine($values, $values);
    }
}