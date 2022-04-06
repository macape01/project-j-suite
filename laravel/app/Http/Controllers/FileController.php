<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;
class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::all();
        \Log::debug($files);

        return view("files.index", [
            "files" => $files
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('files.create');
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
           'upload' => 'required|mimes:gif,jpeg,jpg,png|max:2048'
       ]);
      
       // Obtenir dades del fitxer
       $upload = $request->file('upload');
       $fileName = $upload->getClientOriginalName();
       $fileSize = $upload->getSize();
       \Log::debug("Storing file '{$fileName}' ($fileSize)...");
 
       // Pujar fitxer al disc dur
       $uploadName = time() . '_' . $fileName;
       $filePath = $upload->storeAs(
           'uploads',      // Path
           $uploadName ,   // Filename
           'public'        // Disk
       );
      
       if (\Storage::disk('public')->exists($filePath)) {
           \Log::debug("Local storage OK");
           $fullPath = \Storage::disk('public')->path($filePath);
           \Log::debug("File saved at {$fullPath}");
           // Desar dades a BD
           $file = File::create([
               'filepath' => $filePath,
               'filesize' => $fileSize,
           ]);
           \Log::debug("DB storage OK");
           // Patró PRG amb missatge d'èxit
           return redirect()->route('files.show', $file)
               ->with('success', 'File successfully saved');
       } else {
           \Log::debug("Local storage FAILS");
           // Patró PRG amb missatge d'error
           return redirect()->route("files.create")
               ->with('error', 'ERROR uploading file: file already exists');
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        \Log::debug("file".$file);
        //Revisar que ficheroe existe en DB
        $databaseFile = File::find($file->id);
        \Log::debug("database".$databaseFile);

        if ($databaseFile) {
            if (\Storage::disk('public')->exists($file->filepath)) {
                return view("files.show", [
                    "file" => $file
                ]);
            }
        } else {
            // Patró PRG amb missatge d'error
            return redirect()->route("files.index")
                ->with('error', 'ERROR indexing file: file doesnt exists');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        return view("files.edit", [
            "file" => $file
        ]);
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        $validatedData = $request->validate([
            'update' => 'required|mimes:gif,jpeg,jpg,png|max:2048'
        ]);
        
        if ( !$validatedData ){
            return redirect()->route("files.edit", [
                "file" => $file
            ])->withErrors('error',"La imatge cagó");
        }

        $update = $request->file('update');

        $fileName = $update->getClientOriginalName();
        $fileSize = $update->getSize();

        // Pujar fitxer al disc dur
        $uploadName = time() . '_' . $fileName;
        $filePath = $update->storeAs(
            'uploads',      // Path
            $uploadName ,   // Filename
            'public'        // Disk
        );
        \Log::debug("Storing file '{$fileName}' ($fileSize)...");

        \Log::debug("update ".$update);
        
        $newFile=File::find($file->id);
        $newFile->update(['filepath'=>$filePath,'filesize'=>$fileSize]); 
        
        \Log::debug("newFile ".$newFile);

        return view("files.show", [
            "file" => $newFile
        ]);
        
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        $file->delete();

        Storage::disk('public')->delete($file->filepath); 

        if (\Storage::disk('public')->missing($file->filepath)) {
            return redirect()->route("files.index")
            ->with('success', 'GUCCI');
        }
        else{
            return redirect()->route("files.show")
            ->with('error', 'ERROR La imatge no ha sigut esborrada');
        }

    }

}
