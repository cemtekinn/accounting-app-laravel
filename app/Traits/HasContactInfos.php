<?php

namespace App\Traits;

use App\Models\ContactInfo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasContactInfos
{
    public function fillContactInfos(array $data): void
    {
        foreach ($data as $type => $value) {
            if (is_array($value)) {
                $this->contactInfos()->create([
                    'type' => $type,
                    'value' => $value['value'] ?? '',
                    'meta' => $value['meta'] ?? [],
                ]);
            } else {
                $this->contactInfos()->create([
                    'type' => $type,
                    'value' => $value,
                ]);
            }
        }
    }

    public function contactInfos(): MorphMany
    {
        return $this->morphMany(ContactInfo::class, 'contactable');
    }
}
