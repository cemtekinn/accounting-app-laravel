<?php

namespace App\Models;

use App\Traits\AutoLogsActivity;
use App\Traits\DateRange;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactInfo extends Model
{
    use SoftDeletes, AutoLogsActivity, DateRange;

    protected $fillable = [
        'type',
        'value',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function contactable(): MorphTo
    {
        return $this->morphTo();
    }
}
