<?php

namespace App\Enums;

enum ContactInfoParams: string
{
    case email = 'email';
    case phone = 'phone';
    case address = 'address';
    case city = 'city';
    case district = 'district';
    case postal_code = 'postal_code';

    public function description(): string
    {
        return match ($this) {
            self::email => 'E-posta',
            self::phone => 'Telefon',
            self::address => 'Adres',
            self::city => 'İl',
            self::district => 'İlçe',
            self::postal_code => 'Posta Kodu',
            default => ucfirst($this->value),
        };
    }
}



