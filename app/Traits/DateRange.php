<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

trait DateRange
{
    public function scopeCreatedAtDateRange(Builder $query, $from, $to = null): Builder
    {
        return $query->whereBetween('created_at', $this->range($from, $to ?? now()));
    }

    public function scopeUpdatedAtDateRange(Builder $query, $from, $to = null): Builder
    {
        return $query->whereBetween('updated_at', $this->range($from, $to ?? now()));
    }

    private function range($from, $to): array
    {
        return [
            Carbon::parse($from)->setTimezone(config('app.timezone'))->startOfDay()->toDateTimeString(),
            Carbon::parse($to)->setTimezone(config('app.timezone'))->endOfDay()->toDateTimeString()
        ];
    }
}
