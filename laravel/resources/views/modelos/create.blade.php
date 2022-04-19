<x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Create a Model') }}
       </h2>
   </x-slot>
 
   <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="post" action="{{ route('modelos.store') }}" class="flex flex-col items-center space-x-6">
           @csrf
        <label>
            <span class="sr-only">Manufacturer: </span>
            <br>
            <input name="category" type="text"/>
        </label>

        <label>
            <span class="sr-only">Model: </span>
            <br>
            <input name="category" type="text"/>
        </label>

        <label>
            <span class="sr-only">Price: </span>
            <br>
            <input name="category" type="text"/>
        </label>

        <label>
            <span class="sr-only">Category_id: </span>
            <br>
            <input name="category" type="text"/>
        </label>
        <label>
            <span class="sr-only">Photo_id: </span>
            <br>
            <input name="category" type="text"/>
        </label>

        <button type="submit" >Envia</button>
       </div>
   </div>
</x-app-layout>