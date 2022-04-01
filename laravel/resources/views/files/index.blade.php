<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Files') }}
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
                                <td scope="col">Filepath</td>
                                <td scope="col">Filesize</td>
                                <td scope="col">Created</td>
                                <td scope="col">Updated</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($files as $file)
                            <tr>
                                <td>{{ $file->id }}</td>
                                <td>{{ $file->filepath }}</td>
                                <td>{{ $file->filesize }}</td>
                                <td>{{ $file->created_at }}</td>
                                <td>{{ $file->updated_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-6">
                        <a class="py-2 px-4 bg-indigo-50 font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75" href="{{ route('files.create') }}" role="button">Add new file</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>