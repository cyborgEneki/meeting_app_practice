<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 6:59 PM
 */

namespace App\Repositories;

use App\Note;
use Illuminate\Http\Request;

interface NoteRepositoryInterface {
    public function allNotes();

    public function createNote(Request $request);

    public function updateNote(Request $request, Note $note);

    public function deleteNote(Note $note);
}