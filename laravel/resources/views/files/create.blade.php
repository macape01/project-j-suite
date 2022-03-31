<x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Create a File') }}
       </h2>
   </x-slot>
 
   <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
       <form method="post" action="{{ route('files.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="upload">File:</label>
                <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="upload"/>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </form>
       </div>
   </div>
</x-app-layout>