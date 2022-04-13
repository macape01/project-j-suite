<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        \Log::debug($categories);

        return view("categories.index", [
            "categories" => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
        
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
            'category' => 'required|max:15'
        ]);
        
        $categoryToFind = Category::where('name' , '=', $request->category)->first();

        \Log::debug("Category".$categoryToFind);

        if ( $categoryToFind ){
            return redirect()->route('categories.index')
            ->with('error', 'Name of the category already in use');
        }
        else{
            $category = Category::create(['name'=>$request->category]);
    
            \Log::debug("Category succesfully created");
            // Patró PRG amb missatge d'èxit
            return redirect()->route('categories.show', $category)
                ->with('success', 'File successfully saved');
        }
    }   

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        \Log::debug("category".$category);
        //Revisar que ficheroe existe en DB
        $category = Category::find($category->id);

        if ($category) {
            return view("categories.show", [
                "category" => $category
            ]);
        } else {
            // Patró PRG amb missatge d'error
            return redirect()->route("categories.index")
                ->with('error', 'ERROR indexing category: category doesnt exists');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view("categories.edit", [
            "category" => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'category' => 'required|max:15'
        ]);
        
        $newCategory=Category::where('name' , '=', $request->category)->first();
        
        var_dump($newCategory);
        if ( $newCategory ){
            return redirect()->route('categories.edit',$category)
            ->with('error', 'Name of the category already in use');
        }
        else{
            $category = Category::find($category->id);
            $category->update(['name'=>$request->category]);
    
            \Log::debug("Category succesfully updated");
            // Patró PRG amb missatge d'èxit
            return redirect()->route('categories.index', $category)
                ->with('success', 'Category successfully updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route("categories.index")
            ->with('success', 'Categoria '.$category->name.' eliminada');
    }
}
