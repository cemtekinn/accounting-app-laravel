<?php

namespace App\Models;

use App\Enums\CategoryType;
use App\Traits\AutoLogsActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes, AutoLogsActivity;

    protected $fillable = [
        'name',
        'description',
        'status',
        'type'
    ];

    protected $casts = [
        'status' => 'boolean',
        'type' => CategoryType::class
    ];

    public function scopeType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): hasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
