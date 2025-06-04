<?php

namespace App\Models;

use App\Enums\CustomerStatus;
use App\Traits\AutoLogsActivity;
use App\Traits\HasContactInfos;
use App\Traits\HasNotes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes, AutoLogsActivity, HasContactInfos, HasNotes;

    protected $fillable = [
        'name',
        'status',
    ];

    protected $casts = [
        'status' => CustomerStatus::class,
    ];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
