<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit the Delivery') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="post" action="{{ route('deliveries.update',$delivery) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label class="block">
                    <span class="sr-only"><strong>horas: </strong>{{$delivery->hours}}</span>
                    <br>
                    <span class="sr-only"><strong>price: </strong>{{$delivery->price}}</span>
                    <br>
                    <span class="sr-only"><strong>company_id: </strong>{{$delivery->company_id}}</span>
                </label>
                <br>
                <label class="block">
                    <span class="sr-only">Introduce el cambio de hora: </span>
                    <input name="hours" type="text" />
                </label>
                <label class="block">
                    <span class="sr-only">Introdueix el nuevo precio: </span>
                    <input name="price" type="text" />
                </label>
                <label class="block">
                    <span class="sr-only">Introdueix la nueva empresa: </span>
                    <select name="company_id" value>
                        @foreach($companies as $company)
                        <option value={{$company->id}}>
                            {{$company->name}}
                        </option>
                        @endforeach
                    </select>
                </label>
                <br>
                <button class="py-2 px-4 bg-indigo-50 font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75" type="submit">Puja novament</button>
            </form>
        </div>
    </div>
</x-app-layout>