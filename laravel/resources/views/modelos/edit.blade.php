<x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Edit the Model') }}
       </h2>
   </x-slot>
 
   <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="post" action="{{ route('modelos.update',$modelo,$file) }}" enctype="multipart/form-data" >
           @csrf
           @method('PUT')
        <div class="block">
            <label>Modelo: </label>
            <input name="model" class="sr-only" type="text" value="{{$modelo->model}}"/>
            <br>
        </div>
        <div class="block">
            <label>Manufacturer: </label>
            <input name="manufacturer" class="sr-only" type="text" value="{{$modelo->manufacturer}}"/>
            <br>
        </div>
        <div class="block">
            <label>Price: </label>
            <input name="price" class="sr-only" type="text" value="{{$modelo->price}}"/>
            <br>
        </div>
        <div class="block">
            <span><strong> Category: </strong>{{$category->name}}</span>
            <br>
        </div>
        <label>
            <span class="sr-only">Select a category: </span>
            <br>
            <select name="category_id" value>
                @foreach($categories as $categoryy)
                <option value={{$category->id}}>
                    {{$categoryy->name}}
                </option>
                @endforeach
            </select>
        </label>
        <div class="block">
            <label>Photo: </label>
            <br>
            <img  width="200px" height="200px" class="img-fluid" src="{{ asset("storage/{$file->filepath}") }}" />
            <br>
            <span class="sr-only">Puja un nou arxiu</span>
            <br>
            <input type="file" name="photo" class="block w-full text-sm text-slate-500
            file:mr-4 file:py-2 file:px-4
            file:rounded-full file:border-0
            file:text-sm file:font-semibold
            file:bg-violet-50 file:text-violet-700
            hover:file:bg-violet-100
            "/>
        </div>
        <br>
        <br>
        <br>
        <button type="submit">Puja novament</button>
        </form>
       </div>
   </div>
</x-app-layout>