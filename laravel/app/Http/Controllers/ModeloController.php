<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use App\Models\Category;
use App\Models\File;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelos = Modelo::all();
        \Log::debug($modelos);

        return view("modelos.index", [
            "modelos" => $modelos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modelos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar fitxer
        $validatedData = $request->validate([
            'manufacturer' => 'required|max:30',
            'model' => 'required|max:30',
            'price' => 'required',
            'photo_id' => 'required',
            'category_id' => 'required'
        ]);
        $category = Category::find($category_id);
        $photo = File::find($photo_id);

        if ( $category == null){
            return redirect()->route('categories.index')
            ->with('error', 'Category couldnt be found!');
        }
        if ( $photo == null){
            return redirect()->route('categories.index')
            ->with('error', 'Photo couldnt be found!');
        }
        $modelo = Modelo::create($request->all());

        \Log::debug("Model succesfully created");
        return redirect()->route('categories.show')
            ->with('error', 'Model succesfully created');
        // Patró PRG amb missatge d'èxit
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function show(Modelo $modelo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function edit(Modelo $modelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modelo $modelo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modelo $modelo)
    {
        //
    }
}
