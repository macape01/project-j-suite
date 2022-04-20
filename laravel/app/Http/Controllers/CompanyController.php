<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\File;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        \Log::debug($companies);

        return view("companies.index", [
            "companies" => $companies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
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
            'name' => 'required|max:50',
            'phone' => 'required|max:12',
            'email' => 'required|max:50',
            'logo' => 'required|mimes:gif,jpeg,jpg,png|max:2048'
        ]);
        
        // $companyToFind = Company::where('name' , '=', $request->company)->first();
        $upload = $request->file('logo');
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


            $company = Company::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'logo_id' => $file->id,
            ]);
            \Log::debug("DB storage OK");
            // Patró PRG amb missatge d'èxit
            return redirect()->route('companies.show', $company)
                ->with('success', 'File successfully saved');
        } else {
            \Log::debug("Local storage FAILS");
            // Patró PRG amb missatge d'error
            return redirect()->route("companies.create")
                ->with('error', 'ERROR uploading file: file already exists');
        }
        \Log::debug("Company".$companyToFind);
        // if ( $companyToFind ){
        //     return redirect()->route('companies.index')
        //     ->with('error', 'Name of the company already in use');
        // }
        // else{
        //     $company = Company::create(['name'=>$request->company]);
    
        //     \Log::debug("Companie succesfully created");
        //     // Patró PRG amb missatge d'èxit
        //     return redirect()->route('companies.show', $company)
        //         ->with('success', 'File successfully saved');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        var_dump(File::find($company->logo_id)->filepath);
        \Log::debug("company".$company);
        //Revisar que ficheroe existe en DB
        $company = Company::find($company->id);

        if ($company) {
            return view("companies.show", [
                "company" => $company,
                "file"=> File::find($company->logo_id)
            ]);
        } else {
            // Patró PRG amb missatge d'error
            return redirect()->route("companies.index")
                ->with('error', 'ERROR indexing company: company doesnt exists');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view("companies.edit", [
            "company" => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'phone' => 'required|max:12',
            'email' => 'required|max:50',
            'logo' => 'required|mimes:gif,jpeg,jpg,png|max:2048'
        ]);
        
        // $companyToFind = Company::where('name' , '=', $request->company)->first();
        $upload = $request->file('logo');
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


            $company->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'logo_id' => $file->id,
            ]);
            \Log::debug("DB storage OK");
            // Patró PRG amb missatge d'èxit
            return redirect()->route('companies.show', $company)
                ->with('success', 'File successfully saved');
        } else {
            \Log::debug("Local storage FAILS");
            // Patró PRG amb missatge d'error
            return redirect()->route("companies.create")
                ->with('error', 'ERROR uploading file: file already exists');
        }
        \Log::debug("Company".$companyToFind);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route("companies.index")
            ->with('success', 'company '.$company->name.' eliminada');
    }
}
