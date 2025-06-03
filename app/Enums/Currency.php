<?php


namespace App\Enums;

enum Currency: string
{
    case TRY = 'TRY';
    case USD = 'USD';
    case EUR = 'EUR';
    case GBP = 'GBP';

    public function description(): string
    {
        return match ($this) {
            self::TRY => 'Türk Lirası',
            self::USD => 'Dolar',
            self::EUR => 'Euro',
            self::GBP => 'Pound',
        };
    }

    public function sign(): string
    {
        return match ($this) {
            self::TRY => '₺',
            self::USD => '$',
            self::EUR => '€',
            self::GBP => '£',
            default => '',
        };
    }
}
