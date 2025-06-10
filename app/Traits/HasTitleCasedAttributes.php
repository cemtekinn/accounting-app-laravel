<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasTitleCasedAttributes
{
    // Converts selected fields to uppercase when updating and saving
    // e.g: first_name => ahmet => Ahmet
    public static function bootHasTitleCasedAttributes(): void
    {
        static::creating(function ($model) {
            $model->applyTitleCase();
        });

        static::updating(function ($model) {
            $model->applyTitleCase();
        });
    }

    protected function applyTitleCase(): void
    {
        foreach ($this->titleCasedAttributes as $attribute) {
            if (!empty($this->{$attribute}) && is_string($this->{$attribute})) {
                $this->{$attribute} = Str::title($this->{$attribute});
            }
        }
    }
}
