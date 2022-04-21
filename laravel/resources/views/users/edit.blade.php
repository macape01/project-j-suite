<x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Edit the User') }}
       </h2>
   </x-slot>
 
   <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="post" action="{{ route('users.update',$user) }}" enctype="multipart/form-data" >
           @csrf
           @method('PUT')
        <div class="block">
            <label>Name: </label>
            <input name="name" class="sr-only" type="text" value="{{$user->name}}"/>
            <br>
        </div>
        <div class="block">
            <label>Password: </label>
            <input name="password" class="sr-only" type="text" value="{{$user->password}}"/>
            <br>
        </div>
        <div class="block">
            <label>Role ID: </label>
            <br>
            <select name="role_id" value>
                @foreach($roles as $role)
                <option value={{$role->id}}>
                    {{$role->name}}
                </option>
                @endforeach
            </select>
        </div>
        <div class="block">
            <label>Avatar: </label>
            <br>
            <img  width="200px" height="200px" class="img-fluid" src="{{ asset("storage/{$file->filepath}") }}" />
            <br>
            <span class="sr-only">Puja un nou arxiu</span>
            <br>
            <input type="file" name="avatar" class="block w-full text-sm text-slate-500
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