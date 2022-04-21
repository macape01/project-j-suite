<x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Create a Role') }}
       </h2>
   </x-slot>
 
   <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="post" action="{{ route('roles.store')}}" class="flex items-center space-x-6">
           @csrf
        <label class="block">
            <span class="sr-only">Introdueix un nom per al nou Role: </span>
            <input name="name" type="text"/>
        </label>
        <button type="submit">Envia</button>
        </form>
       </div>
   </div>
</x-app-layout>