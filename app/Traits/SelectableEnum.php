<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

trait SelectableEnum
{
    public static function select(): array
    {
        $res = [];
        foreach (self::cases() as $value) {
            $res[] = ['value' => $value, 'title' => $value->description()];
        }

        return $res;
    }
}
