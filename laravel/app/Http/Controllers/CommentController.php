<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tid)
    {
        $comments = DB::table('comments')
        ->select('id', 'ticket_id', 'msg', 'created','author_id')
        ->where('ticket_id','=',$tid)
        ->get();
        return \response($comments);
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
            'msg' => 'required|max:255',
            'author_id' => 'required',
            'created' => 'required',
            'ticket_id' => 'required',
        ]);
        $comment = Comment::create($request->all());
        return \response($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $tid
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tid,$id)
    {
        $comment = DB::table('comments')
        ->select('id', 'ticket_id', 'msg', 'created','author_id')
        ->where('ticket_id','=',$tid)
        ->where('id','=',$id)
        ->get();

        

        /* $ticket = Ticket::find($tid);
        if ($ticket) {
            $comment = Comment::find($id);
            if ($comment) {
                if ($comment->ticket_id != $tid) {
                    return \response(["message" => "Comment $id doesn't belong to ticket $tid"], 403);
                } else {
                    return \response($comment, 200);
                }
            } else {
                return \response(["message" => "Comment $id not found"], 404);
            }
        } else {
            return \response(["message" => "Ticket $tid not found"], 404);
        } */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $tid
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tid, $id)
    {
        $comment=Comment::find($id);
        $comment->update($request->all());
        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Comment::destroy($id);   
    }
}
