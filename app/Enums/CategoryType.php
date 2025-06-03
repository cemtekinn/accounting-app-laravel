<?php


namespace App\Enums;

enum CategoryType: string
{
    case product = 'product';
    case transaction = 'transaction';

    public function description(): string
    {
        return match ($this) {
            self::product => 'Ürün',
            self::transaction => 'İşlem',
        };
    }
}
