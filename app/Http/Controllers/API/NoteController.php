<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Note;
use App\Repositories\NoteRepositoryInterface;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    protected $notesRepository;

    public function __construct(NoteRepositoryInterface $notesRepository)
    {
        $this->notesRepository = $notesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = $this->notesRepository->allNotes();

        return response()->json($notes);
    }

    public function getMeetingNotes($meetingId)
    {
        $notes = $this->notesRepository->allMeetingNotes($meetingId);

        return $notes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteRequest $request)
    {
        $notes = $this->notesRepository->createNote($request);

        return response()->json($notes, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        return response()->json($note, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(NoteRequest $request, Note $note)
    {
        $this->notesRepository->updateNote($request, $note);
        return response()->json(['You have successfully updated your notes.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $this->notesRepository->deleteNote($note);
        return response()->json(['You have successfully deleted this note.'],  200);
    }
}
