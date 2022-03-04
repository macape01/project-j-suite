<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Chat;



class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chat = DB::table('chats')
        ->select('id', 'name', 'author_id', 'created')
        ->get();
        return \response($chat);
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
            'id' => 'required',
            'name' => 'required',
            'author_id' => 'required',
            'created' => 'required',
        ]);
        $chat = Chat::create($request->all());
        return \response($chat);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chat = DB::table('chats')
        ->select('id', 'author_id', 'message', 'created_at', 'updated_at', 'publicgroup_id', 'privateuser_id')
        ->where('id','=',$id)
        ->get();
        return \response($chat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $chat=Chat::find($id);
        $chat->update($request->all());
        return $chat;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Chat::destroy($id);
    }
}
