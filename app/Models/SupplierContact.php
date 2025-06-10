<?php

namespace App\Models;

use App\Traits\AutoLogsActivity;
use App\Traits\DateRange;
use App\Traits\HasTitleCasedAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierContact extends Model
{
    use SoftDeletes, AutoLogsActivity, DateRange, HasTitleCasedAttributes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'position',
    ];

    protected $appends = [
        'full_name',
    ];
    protected array $titleCasedAttributes = ['first_name', 'last_name', 'position'];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

}
