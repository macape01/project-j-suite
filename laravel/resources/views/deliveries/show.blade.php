<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Delivery') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <span><strong>Delivery hours: </strong>{{$delivery->hours}}</span>
                    <br>
                    <span><strong>Delivery price: </strong>{{$delivery->price}}</span>
                    <br>
                    <span><strong>Delivery company: </strong>{{$delivery->company_id}}</span>
                    <div class="mt-8">
                        <a class="py-2 px-4 bg-indigo-50 font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75" href="{{ route('deliveries.edit',$delivery) }}" role="button">Edit delivery</a>
                    </div>
                    <form method="post" action="{{ route('deliveries.destroy',$delivery) }}">
                        @csrf
                        @method('delete')
                        <div class="mt-8">
                            <button class="py-2 px-4 bg-indigo-50 font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75" type="submit">Delete delivery</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>