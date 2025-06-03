<?php

namespace App\Enums;

enum CustomerType: string
{
    case Active = 'active';
    case Passive = 'passive';
    
    public function description(): string
    {
        return match ($this) {
            self::Active => 'Aktif',
            self::Passive => 'Pasif',
        };
    }
}
