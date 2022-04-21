<x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Edit the Role') }}
       </h2>
   </x-slot>
 
   <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="post" action="{{ route('roles.update',$role) }}" enctype="multipart/form-data" >
           @csrf
           @method('PUT')
        <label class="block">
            <span class="sr-only"><strong>Name: </strong>{{$role->name}}</span>
            <br>
            <span class="sr-only"><strong>Id: </strong>{{$role->id}}</span>
        </label>
        <br>
        <label class="block">
            <span class="sr-only">Actualitza el nom del Role: </span>
            <input name="name" type="text"/>
        </label>
        <br>
        <button class="py-2 px-4 bg-indigo-50 font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75" type="submit">Puja novament</button>
        </form>
       </div>
   </div>
</x-app-layout>