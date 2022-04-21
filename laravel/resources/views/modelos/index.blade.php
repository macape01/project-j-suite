<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modelos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table">
                        <thead>
                            <tr>
                                <td scope="col">ID</td>
                                <td scope="col">Manufacturer</td>
                                <td scope="col">Model</td>
                                <td scope="col">Price</td>
                                <td scope="col">Category_ID</td>
                                <td scope="col">Photo_ID</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modelos as $modelo)
                            <tr>
                                <td>{{ $modelo->id }}</td>
                                <td>{{ $modelo->manufacturer }}</td>
                                <td>{{ $modelo->model }}</td>
                                <td>{{ $modelo->price }}</td>
                                <td>{{ $modelo->category_id }}</td>
                                <td>{{ $modelo->photo_id }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-6">
                        <a class="py-2 px-4 bg-indigo-50 font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75" href="{{ route('modelos.create') }}" role="button">Add new Model</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>