<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    public static function put($key, $value)
    {
        return self::updateOrCreate(['key' => $key], ['value' => json_encode($value)]);
    }

    public static function get($key, $default = null)
    {
        return self::firstOrCreate(['key' => $key], ['value' => json_encode($default)]);
    }

    public function getValueAttribute()
    {
        return json_decode($this->attributes['value'], true);
    }
}
