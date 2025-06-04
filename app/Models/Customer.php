<?php

namespace App\Models;

use App\Enums\CustomerType;
use App\Traits\AutoLogsActivity;
use App\Traits\HasContactInfos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes, AutoLogsActivity, HasContactInfos;

    protected $fillable = [
        'name',
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
