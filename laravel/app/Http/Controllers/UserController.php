<?php

namespace App\Http\Controllers;
use App\Models\File;
use App\Models\Role;
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
        return view('users.create',[
            "roles" => Role::all()
        ]);    }
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
            'avatar' => 'required',
        ]);

        //Get Data From Avatar
        $photo = $request->file('avatar');
        $fileName = $photo->getClientOriginalName();
        $fileSize = $photo->getSize();
        
        // Pujar fitxer al disc dur
        $photoName = time() . '_' . $fileName;
        $filePath = $photo->storeAs(
            'uploads',      // Path
            $photoName ,   // Filename
            'public'        // Disk
        );

        if (\Storage::disk('public')->exists($filePath)) {
            $fullPath = \Storage::disk('public')->path($filePath);
            // Desar dades a BD
            $file = File::create([
                'filepath' => $filePath,
                'filesize' => $fileSize,
            ]);
            $id = $file->id;
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role_id' => $request->role_id,
                'avatar_id' => $id,
            ]);
            return redirect()->route('users.show', $user)
                ->with('success', 'User successfully saved');
        } else {
            return redirect()->route("users.create")
                ->with('error', 'ERROR creating user: file already exists');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if ( $user ){
            return view("users.show", [
                "user" => $user,
                "file" => File::find($user->avatar_id),
            ]);
        }
        else{
            return redirect()->route("users.index")
                ->with('error', 'ERROR the user doesnt exists');
        } 
    }

    public function edit(User $user)
    {
        if ( $user ){
            return view("users.edit", [
                "user" => $user,
                "file" => File::find($user->avatar_id),
                "roles" => Role::all(),
            ]);
        }
        else{
            return redirect()->route("users.index")
                ->with('error', 'ERROR the user doesnt exists');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:30',
            'password' => 'required|max:120',
            'role_id' => 'required',
            'avatar' => 'required',
        ]);

        //Get Data From Avatar
        $photo = $request->file('avatar');
        $fileName = $photo->getClientOriginalName();
        $fileSize = $photo->getSize();
        
        // Pujar fitxer al disc dur
        $photoName = time() . '_' . $fileName;
        $filePath = $photo->storeAs(
            'uploads',      // Path
            $photoName ,   // Filename
            'public'        // Disk
        );

        if (\Storage::disk('public')->exists($filePath)) {
            $fullPath = \Storage::disk('public')->path($filePath);
            // Desar dades a BD
            $file = File::create([
                'filepath' => $filePath,
                'filesize' => $fileSize,
            ]);
            $id = $file->id;
            $user->update([
                'name' => $request->name,
                'password' => $request->password,
                'role_id' => $request->role_id,
                'avatar_id' => $id,
            ]);
            return redirect()->route('users.show', $user)
                ->with('success', 'User successfully updated');
        } else {
            return redirect()->route("users.edit")
                ->with('error', 'ERROR updating user: file already exists');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        
        return redirect()->route("users.index")
        ->with('success', 'GUCCI, modelo: '.$user->name.' destroyed');
        
    }
}
