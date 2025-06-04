<?php

namespace App\Enums;

enum CustomerType: string
{
    case active = 'active';
    case passive = 'passive';

    public function description(): string
    {
        return match ($this) {
            self::active => 'Aktif',
            self::passive => 'Pasif',
        };
    }
}
