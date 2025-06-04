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

    public function addNote(string $content, ?string $title = null): void
    {
        $this->notes()->create([
            'title' => $title,
            'content' => $content,
        ]);
    }

    public function fillNotes(array $notes): void
    {
        foreach ($notes as $note) {
            $this->addNote(
                content: $note['content'],
                title: $note['title'] ?? null
            );
        }
    }
}
