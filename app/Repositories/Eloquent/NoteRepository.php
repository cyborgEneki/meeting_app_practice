<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 7:08 PM
 */

namespace App\Repositories;

use App\Http\Resources\NoteResource;
use App\Note;
use Illuminate\Http\Request;

class NoteRepository implements NoteRepositoryInterface
{
    public function allNotes()
    {
        return NoteResource::collection(Note::all());
    }

    public function createNote(Request $request)
    {
        return Note::create($request->all());
    }

    public function updateNote(Request $request, Note $note)
    {
        return $note->update($request->all());
    }

    /**
     * @param Note $note
     * @return bool|null
     * @throws \Exception
     */
    public function deleteNote(Note $note)
    {
        return $note->delete($note);
    }
}