<?php

namespace App\Models;

use App\Traits\AutoLogsActivity;
use App\Traits\DateRange;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes, AutoLogsActivity, DateRange;

    protected $fillable = ['name', 'short_name'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
