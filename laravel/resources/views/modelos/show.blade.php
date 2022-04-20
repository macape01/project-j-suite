<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modelo') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <span><strong> Id: </strong>{{$modelo->id}}</span>
                    <br>
                    <span><strong>Model Name: </strong>{{$modelo->model}}</span>
                    <br>
                    <span><strong>Manufacturer: </strong>{{$modelo->manufacturer}}</span>
                    <br>
                    <span><strong>Price: </strong>{{$modelo->price}}</span>
                    <br>
                    <span><strong>Photo: </strong>
                    <br>
                    <img class="img-fluid" src="{{ asset("storage/{$file->filepath}") }}" />
                    <br>
                    <span><strong>Category: </strong>{{$category->name}}</span>
                    <br>
                <div class="mt-8">
                    <a class="py-2 px-4 bg-indigo-50 font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75" href="{{ route('modelos.edit',$modelo) }}" role="button">Edit model</a>
                </div>
                    <form method="post" action="{{ route('modelos.destroy',$modelo) }}">
                        @csrf
                        @method('delete')
                        <div class="mt-8">
                            <button class="py-2 px-4 bg-indigo-50 font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75" type="submit" >Delete model</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>