<?php

namespace App\Models;

use App\Enums\CustomerStatus;
use App\Traits\AutoLogsActivity;
use App\Traits\HasNotes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes, AutoLogsActivity, HasNotes;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'address',
        'city',
        'district',
        'status',
    ];

    protected $casts = [
        'status' => CustomerStatus::class,
    ];

    protected $appends = [
        'full_name',
    ];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

}
