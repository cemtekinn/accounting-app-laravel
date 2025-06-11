<?php

namespace App\Enums;

enum SaleStatus: string
{
    case draft = 'draft';
    case pending = 'pending';
    case completed = 'completed';
    case cancelled = 'cancelled';

    public function description(): string
    {
        return match ($this) {
            self::draft => 'Taslak',
            self::pending => 'Bekliyor',
            self::completed => 'Tamamlandı',
            self::cancelled => 'İptal Edildi',
        };
    }
}
