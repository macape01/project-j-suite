<x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Create a Model') }}
       </h2>
   </x-slot>
 
   <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="post" action="{{ route('modelos.store') }}" enctype="multipart/form-data" class="flex flex-col items-center space-x-6">
           @csrf
        <label>
            <span class="sr-only">Manufacturer: </span>
            <br>
            <input name="manufacturer" type="text"/>
        </label>

        <label>
            <span class="sr-only">Model: </span>
            <br>
            <input name="model" type="text"/>
        </label>

        <label>
            <span class="sr-only">Price: </span>
            <br>
            <input name="price" type="text"/>
        </label>

        <label>
            <span class="sr-only">Select a category: </span>
            <br>
            <select name="category_id" value>
                @foreach($categories as $category)
                <option value={{$category->id}}>
                    {{$category->name}}
                </option>
                @endforeach
            </select>
        </label>
        <label>
            <span class="sr-only">Select a file: </span>
            <input type="file" name="photo" class="block w-full text-sm text-slate-500
            file:mr-4 file:py-2 file:px-4
            file:rounded-full file:border-0
            file:text-sm file:font-semibold
            file:bg-violet-50 file:text-violet-700
            hover:file:bg-violet-100
            "/>
        </label>

        <button type="submit" >Envia</button>
       </div>
   </div>
</x-app-layout>