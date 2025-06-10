<?php

namespace App\Models;

use App\Enums\ProductStatus;
use App\Traits\HasTitleCasedAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory, SoftDeletes, HasTitleCasedAttributes;

    protected $fillable = [
        'category_id',
        'stock_code',
        'barcode',
        'name',
        'description',
        'price',
        'stock',
        'unit_id',
        'status',
        'expiry_date',
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'price' => 'decimal:2',
    ];

    protected array $titleCasedAttributes = ['name'];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeBarcode(Builder $query, string $barcode): Builder
    {
        return $query->where('barcode', $barcode)->first();
    }

    public function scopeOutOfStock(Builder $query): Builder
    {
        return $query->where('stock', '<=', 0);
    }

    public function scopeInStock(Builder $query): Builder
    {
        return $query->where('stock', '>', 0);
    }

    public function scopeExpired(Builder $query): Builder
    {
        return $query->whereDate('expiry_date', '<', Carbon::today());
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', ProductStatus::active);
    }

}
