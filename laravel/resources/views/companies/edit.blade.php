<x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Edit the Company') }}
       </h2>
   </x-slot>
 
   <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="post" action="{{ route('companies.update',$company) }}" enctype="multipart/form-data" >
           @csrf
           @method('PUT')
        <label class="block">
            <span class="sr-only"><strong>Name: </strong>{{$company->name}}</span>
            <br>
            <span class="sr-only"><strong>Logo_id: </strong>{{$company->id}}</span>
            <br>
            <span class="sr-only"><strong>Telefono: </strong>{{$company->phone}}</span>
            <br>
            <span class="sr-only"><strong>Company email: </strong>{{$company->email}}</span>
        </label>
        <br>
        <label class="block">
            <span class="sr-only">Introdueix un nom per actualitzar la company: </span>
            <input name="name" type="text"/>

        </label>
        <label class="block">
            <span class="sr-only">Introdueix el nou telefon: </span>
            <input name="phone" type="text"/>
        </label>
        <label class="block">
            <span class="sr-only">Introdueix el nou email: </span>
            <input name="email" type="text"/>
        </label>
        <label class="block">
            <span class="sr-only">Nou logo (arxiu)</span>
            <input type="file" name="logo" class="block w-full text-sm text-slate-500
            file:mr-4 file:py-2 file:px-4
            file:rounded-full file:border-0
            file:text-sm file:font-semibold
            file:bg-violet-50 file:text-violet-700
            hover:file:bg-violet-100
            "/>
        </label>
        <br>
        <button class="py-2 px-4 bg-indigo-50 font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75" type="submit">Puja novament</button>
        </form>
       </div>
   </div>
</x-app-layout>