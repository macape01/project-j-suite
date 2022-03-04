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
    public function index()
    {
        $message = DB::table('messages')
        ->select('id', 'author_id', 'message', 'publicgroup_id', 'privateuser_id')
        ->get();
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
            'publicgroup_id' => 'required',
            'privateuser_id' => 'required',
        ]);
        $message = Message::create($request->all());
        return \response($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = DB::table('messages')
        ->select('id', 'author_id', 'message', 'created_at', 'updated_at', 'publicgroup_id', 'privateuser_id')
        ->where('id','=',$id)
        ->get();
        return \response($message);
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
