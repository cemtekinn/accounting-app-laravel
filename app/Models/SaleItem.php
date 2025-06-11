<?php

namespace App\Models;

use App\Traits\AutoLogsActivity;
use App\Traits\DateRange;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleItem extends Model
{
    use SoftDeletes, AutoLogsActivity, DateRange;

    protected $fillable = [
        // Add your fillable fields here
    ];
}
