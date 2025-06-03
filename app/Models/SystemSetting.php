<?php

namespace App\Models;

use App\Traits\AutoLogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SystemSetting extends Model
{
    use AutoLogsActivity, SoftDeletes;

    protected $fillable = [
        'key',
        'value',
    ];

    public static function put($key, $value)
    {
        return self::updateOrCreate(['key' => $key], ['value' => json_encode($value)]);
    }

    public static function take($key)
    {
        return self::firstOrCreate(['key' => $key]);
    }

    public function getValueAttribute()
    {
        return json_decode($this->attributes['value'], true);
    }
}
