<x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Create a File') }}
       </h2>
   </x-slot>
 
   <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="post" action="{{ route('files.store') }}" enctype="multipart/form-data" class="flex items-center space-x-6">
           @csrf
        <label class="block">
            <span class="sr-only">Escull un arxiu</span>
            <input type="file" name="upload" class="block w-full text-sm text-slate-500
            file:mr-4 file:py-2 file:px-4
            file:rounded-full file:border-0
            file:text-sm file:font-semibold
            file:bg-violet-50 file:text-violet-700
            hover:file:bg-violet-100
            "/>
        </label>
        <button type="submit">Envia</button>
        </form>
       </div>
   </div>
</x-app-layout>