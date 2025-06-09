<?php

namespace App\Traits;

use App\Models\Note;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasNotes
{
    public function notes(): MorphMany
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    public function addNote(string $content, ?string $title = null): ?Note
    {
        $note = $this->notes()->create([
            'title' => $title,
            'content' => $content,
        ]);

        return $note;
    }
}
