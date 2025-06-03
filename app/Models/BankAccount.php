<?php

namespace App\Models;

use App\Enums\AccountType;
use App\Enums\Currency;
use App\Traits\AutoLogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model
{
    use SoftDeletes,AutoLogsActivity;

    protected $fillable = [
        'account_name',
        'bank_name',
        'iban',
        'balance',
        'account_number',
        'account_type',
        'opening_date',
        'currency',
        'description',
    ];

    protected $casts = [
        'opening_date' => 'datetime',
        'account_type' => AccountType::class,
        'currency' => Currency::class,
    ];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
