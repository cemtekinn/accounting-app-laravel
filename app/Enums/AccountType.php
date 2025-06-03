<?php

namespace App\Enums;

/**
 * Enum representing different types of bank accounts.
 */
enum AccountType: string
{
    case CHECKING = 'checking';
    case SAVINGS = 'savings';
    case FIXED_DEPOSIT = 'fixed_deposit';
    case CREDIT = 'credit';
    case INVESTMENT = 'investment';
    case BUSINESS = 'business';
    case FOREIGN_CURRENCY = 'foreign_currency';
    case GOLD = 'gold';

    public function descriptions(): string
    {
        return match ($this) {
            self::CHECKING => 'Vadesiz',
            self::SAVINGS => 'Tasarruf',
            self::FIXED_DEPOSIT => 'Vadeli',
            self::CREDIT => 'Kredi',
            self::INVESTMENT => 'Yatırım',
            self::BUSINESS => 'Şirket Hesabı',
            self::FOREIGN_CURRENCY => 'Döviz',
            self::GOLD => 'Altın',
        };
    }

}
