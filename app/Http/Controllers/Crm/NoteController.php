<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Crm\NoteResource;
use App\Models\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NoteController extends ApiController
{

    /**
     * Display the specified resource.
     */
    public function show(Note $note): NoteResource
    {
        $this->authorize('view', $note);
        return NoteResource::make($note);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note): JsonResponse
    {
        $this->authorize('update', $note);
        $data = $request->validated();
        $note->update($data);
        return $this->success('Not başarıyla güncellendi.', NoteResource::make($note));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note): JsonResponse
    {
        $this->authorize('delete', $note);
        $note->delete();
        return $this->success('Not başarıyla silindi.');
    }
}
