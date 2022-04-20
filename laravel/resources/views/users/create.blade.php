<x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Create a User') }}
       </h2>
   </x-slot>
 
   <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="post" action="{{ route('users.store') }}" class="flex flex-col items-center space-x-6">
           @csrf
        <label>
            <span class="sr-only">Name: </span>
            <br>
            <input name="name" type="text"/>
        </label>
        <label>
            <span class="sr-only">Email: </span>
            <br>
            <input name="email" type="text"/>
        </label>
        <label>
            <span class="sr-only">Verified At: </span>
            <br>
            <input name="email_verified_at" type="text"/>
        </label>
        <label>
            <span class="sr-only">Password: </span>
            <br>
            <input name="password" type="text"/>
        </label>
        <label>
            <span class="sr-only">Remember Token: </span>
            <br>
            <input name="remember_token" type="text"/>
        </label>
        <label>
            <span class="sr-only">Created At: </span>
            <br>
            <input name="created_at" type="text"/>
        </label>
        <label>
            <span class="sr-only">Updated At: </span>
            <br>
            <input name="updated_at" type="text"/>
        </label>
        <label>
            <span class="sr-only">Role ID: </span>
            <br>
            <input name="role_id" type="text"/>
        </label>
        <label>
            <span class="sr-only">Avatar ID: </span>
            <br>
            <input name="avatar_id" type="file"/>
        </label>
        <button type="submit" >Envia</button>
       </div>
   </div>
</x-app-layout>