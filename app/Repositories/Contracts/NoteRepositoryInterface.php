<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 6:59 PM
 */

namespace App\Repositories;

use App\Http\Requests\NoteRequest;
use App\Note;
use Illuminate\Http\Request;

interface NoteRepositoryInterface {
    public function allNotes();

    public function allMeetingNotes($meetingId);

    public function createNote(NoteRequest $request);

    public function updateNote(NoteRequest $request, Note $note);

    public function deleteNote(Note $note);
}