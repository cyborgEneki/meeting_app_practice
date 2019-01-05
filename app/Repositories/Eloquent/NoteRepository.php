<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 7:08 PM
 */

namespace App\Repositories;

use App\Http\Requests\NoteRequest;
use App\Http\Resources\NoteResource;
use App\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteRepository implements NoteRepositoryInterface
{
    public function allNotes()
    {
        return NoteResource::collection(Note::all());
    }

    public function allMeetingNotes($meetingId)
    {
        return NoteResource::collection(Note::take(10)->get());
    }

    public function createNote(NoteRequest $request)
    {
        $request['user_id'] = Auth::id();
        return Note::create($request->all());
    }

    public function updateNote(NoteRequest $request, Note $note)
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