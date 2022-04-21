<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Delivery') }}
        </h2>
    </x-slot>
    <style>
        td {
            padding: 10px;
            text-align: center;
        }
    </style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table">
                        <thead>
                            <tr>
                                <td scope="col">ID</td>
                                <td scope="col">Hours</td>
                                <td scope="col">Price</td>
                                <td scope="col">Company_id</td>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deliveries as $delivery)
                            <tr>
                                <td>{{ $delivery->id }}</td>
                                <td>{{ $delivery->hours }}</td>
                                <td>{{ $delivery->price }}</td>
                                <td>{{ $delivery->company_id }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-6">
                        <a class="py-2 px-4 bg-indigo-50 font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75" href="{{ route('deliveries.create') }}" role="button">Add new Delivery</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>