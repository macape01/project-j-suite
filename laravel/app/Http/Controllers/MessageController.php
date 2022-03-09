<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Message;



class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cid)
    {
        $messages = Message::where('chat_id','=',$cid)->get();

        return \response($message);
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
            'author_id' => 'required',
            'message' => 'required',
        ]);
        $message = Message::create($request->all());
        return \response($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $tid
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cid,$id)
    {
        $message = Comment::where('chat_id','=',$tid)->findOrFail($id);

        return \response($message);
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
        $message=Message::find($id);
        $message->update($request->all());
        return $message;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Message::destroy($id);
    }
}
