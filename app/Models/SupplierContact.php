<?php

namespace App\Models;

use App\Traits\AutoLogsActivity;
use App\Traits\DateRange;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierContact extends Model
{
    use SoftDeletes, AutoLogsActivity, DateRange;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'position',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

}
