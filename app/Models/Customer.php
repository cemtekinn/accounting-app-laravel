<?php

namespace App\Models;

use App\Enums\CustomerType;
use App\Traits\AutoLogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes, AutoLogsActivity;

    protected $fillable = [
        'contact_person',
        'email',
        'phone',
        'address',
        'city',
        'district',
        'postal_code',
        'note',
        'status',
    ];

    protected $casts = [
        'status' => CustomerType::class,
    ];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
