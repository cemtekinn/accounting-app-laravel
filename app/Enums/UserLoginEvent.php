<?php

namespace App\Enums;

enum UserLoginEvent: string
{
    case login = 'login';
    case logout = 'logout';

    public function description(): string
    {
        return match ($this) {
            self::login => __('Giriş yapıldı'),
            self::logout => __('Çıkış yapıldı'),
        };
    }
}
