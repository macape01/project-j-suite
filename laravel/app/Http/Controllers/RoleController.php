<?php

namespace App\Http\Controllers;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view("roles.index", [
            "roles" => $roles
        ]);       }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);
        
        $roleToFind = Role::where('name' , '=', $request->name)->first();

        if ( $roleToFind ){
            return redirect()->route('roles.index')
            ->with('error', 'Name of roles already exists');
        }
        else{
            $role = Role::create(['name'=>$request->name]);
    
            return redirect()->route('roles.show', $role)
                ->with('success', 'File successfully saved');
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $role = Role::find($role->id);

        if ($role) {
            return view("roles.show", [
                "role" => $role
            ]);
        } else {
            return redirect()->route("roles.index")
                ->with('error', 'ERROR indexing role: role doesnt exists');
        }    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view("roles.edit", [
            "role" => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);
        
        $newRole=Role::where('name' , '=', $request->name)->first();
        
        var_dump($newRole);
        if ( $newRole ){
            return redirect()->route('roles.edit',$role)
            ->with('error', 'Name of the role already in use');
        }
        else{
            $role = Role::find($role->id);
            $role->update(['name'=>$request->name]);
    
            return redirect()->route('roles.index', $role)
                ->with('success', 'Role successfully updated');
        }    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route("roles.index")
            ->with('success', 'Role '.$role->name.' eliminada');
    }
}
