<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Note;


class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($taid)
    {
        $notes = Note::where('task_id', '=' ,$taid)->get();
        return \response($notes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'max:255',
            'task_id' => 'required',
        ]);
        $note = Note::create($request->all());
        return \response($note);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id 
     * @param  int  $taid
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notes = Note::where('task_id','=',$taid)->findOrFail($id);
        return \response($notes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  int  $taid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $taid, $id)
    {
        $note=Note::find($id);
        $note->update($request->all());
        return $note;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Note::destroy($id);

    }
}
