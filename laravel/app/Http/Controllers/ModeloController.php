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
        return view('modelos.create',[
            "categories" => Category::all()
        ]);
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
            'photo' => 'required|mimes:gif,jpeg,jpg,png|max:2048',
            'category_id' => 'required'
        ]);
        \Log::debug($request);

        \Log::debug("photo".$request->file("photo"));
        \Log::debug("category".$request->category_id);

        $photo = $request->file('photo');
        $fileName = $photo->getClientOriginalName();
        $fileSize = $photo->getSize();
        \Log::debug("Storing file '{$fileName}' ($fileSize)...");
    
        // Pujar fitxer al disc dur
        $photoName = time() . '_' . $fileName;
        $filePath = $photo->storeAs(
            'uploads',      // Path
            $photoName ,   // Filename
            'public'        // Disk
        );
        $category = Category::find($request->category_id);

        if ( $category == null){
            return redirect()->route('categories.index')
            ->with('error', 'Category couldnt be found!');
        }
        if (\Storage::disk('public')->exists($filePath)) {
            \Log::debug("Local storage OK");
            $fullPath = \Storage::disk('public')->path($filePath);
            \Log::debug("File saved at {$fullPath}");
            // Desar dades a BD
            $file = File::create([
                'filepath' => $filePath,
                'filesize' => $fileSize,
            ]);
            $id = $file->id;
            $modelo = Modelo::create([
                'manufacturer' => $request->manufacturer,
                'model' => $request->model,
                'price' => $request->price,
                'photo_id' => $id,
                'category_id' => $request->category_id,
            ]);
            \Log::debug("Modelo".$modelo);
            // Patró PRG amb missatge d'èxit
            return redirect()->route('modelos.show', $modelo)
                ->with('success', 'Model successfully saved');
        } else {
            \Log::debug("Local storage FAILS");
            // Patró PRG amb missatge d'error
            return redirect()->route("modelos.create")
                ->with('error', 'ERROR creating modelo: file already exists');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function show(Modelo $modelo)
    {
        if ( $modelo ){
            return view("modelos.show", [
                "modelo" => $modelo,
                "file" => File::find($modelo->photo_id),
                "category" => Category::find($modelo->category_id),
            ]);
        }
        else{
            return redirect()->route("modelos.index")
                ->with('error', 'ERROR the model doesnt exists');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function edit(Modelo $modelo)
    {
        if ( $modelo ){
            return view("modelos.edit", [
                "modelo" => $modelo,
                "file" => File::find($modelo->photo_id),
                "category" => Category::find($modelo->category_id),
                "categories" => Category::all(),
            ]);
        }
        else{
            return redirect()->route("modelos.index")
                ->with('error', 'ERROR the model doesnt exists');
        }
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
        $validatedData = $request->validate([
            'manufacturer' => 'required|max:30',
            'model' => 'required|max:30',
            'price' => 'required',
            'photo' => 'required|mimes:gif,jpeg,jpg,png|max:2048',
            'category_id' => 'required'
        ]);

        \Log::debug("photo".$request->file("photo"));
        \Log::debug("category".$request->category_id);

        $photo = $request->file('photo');
        $fileName = $photo->getClientOriginalName();
        $fileSize = $photo->getSize();
        \Log::debug("Storing file '{$fileName}' ($fileSize)...");
    
        // Pujar fitxer al disc dur
        $photoName = time() . '_' . $fileName;
        $filePath = $photo->storeAs(
            'uploads',      // Path
            $photoName ,   // Filename
            'public'        // Disk
        );
        $category = Category::find($request->category_id);

        if ( $category == null){
            return redirect()->route('modelos.index')
            ->with('error', 'Category couldnt be found!');
        }
        if (\Storage::disk('public')->exists($filePath)) {
            \Log::debug("Local storage OK");
            $fullPath = \Storage::disk('public')->path($filePath);
            \Log::debug("File saved at {$fullPath}");
            // Desar dades a BD
            $file = File::create([
                'filepath' => $filePath,
                'filesize' => $fileSize,
            ]);
            $id = $file->id;
            $modelo->update([
                'manufacturer' => $request->manufacturer,
                'model' => $request->model,
                'price' => $request->price,
                'photo_id' => $id,
                'category_id' => $request->category_id,
            ]);
            \Log::debug("Modelo".$modelo);
            // Patró PRG amb missatge d'èxit
            return redirect()->route('modelos.show', $modelo)
                ->with('success', 'Model successfully updated');
        } else {
            \Log::debug("Local storage FAILS");
            // Patró PRG amb missatge d'error
            return redirect()->route("modelos.edit")
                ->with('error', 'ERROR creating modelo: file already exists');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modelo $modelo)
    {
        $modelo->delete();
        
        return redirect()->route("modelos.index")
        ->with('success', 'GUCCI, modelo: '.$modelo->model.' destroyed');
        
    }
}
