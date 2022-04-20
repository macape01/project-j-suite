<?php

namespace App\Http\Controllers;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::all("name","email");
        $users = User::all();
        return view("users.index", [
            "users" => $users
        ]);    
    }
    public function create()
    {
        return view('users.create');
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
            'name' => 'required|max:30',
            'email' => 'required|max:60',
            'password' => 'required|max:120',
            'role_id' => 'required',
            'avatar_id' => 'required',
        ]);
        $avatar = File::find($avatar_id);

        if ($avatar == null){
            return redirect()->route('users.index')
            ->with('error', 'Photo couldnt be found!');
        }
        $users = User::create($request->all());

        return redirect()->route('users.show')
            ->with('error', 'Model succesfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::find($id);
        return \response($users);    
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
        $users=User::find($id);
        $users->update($request->all());
        return $users;    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return User::destroy($id);
    }
}
