<?php

namespace App\Models;

use App\Enums\Currency;
use App\Enums\SupplierStatus;
use App\Traits\HasNotes;
use App\Traits\HasTitleCasedAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes, HasNotes, HasTitleCasedAttributes;

    protected $fillable = [
        'name',
        'company_name',
        'tax_number',
        'tax_office',
        'iban',
        'bank_name',
        'status',
        'currency',
    ];

    protected $casts = [
        'status' => SupplierStatus::class,
        'currency' => Currency::class,
    ];

    protected array $titleCasedAttributes = [
        'name',
        'company_name',
        'bank_name'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(SupplierContact::class);
    }

}
