<?php

namespace App\Enums;

enum TransactionType: string
{
    case Income = 'income';
    case Expense = 'expense';

    public function description(): string
    {
        return match ($this) {
            self::Income => 'Gelir',
            self::Expense => 'Gider',
        };
    }
}
