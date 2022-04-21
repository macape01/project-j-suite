<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a Delivery') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="post" action="{{ route('deliveries.store') }}" class="flex items-center space-x-6" enctype="multipart/form-data">
                @csrf
                <label class="block">
                    <span class="sr-only">Estas no son horas de llegar cuanto? </span>
                    <input name="hours" type="text" />
                </label>
                <label class="block">
                    <span class="sr-only">Presio? </span>
                    <input name="price" type="text" />
                </label>
                <label>
                    <span class="sr-only">Select a company: </span>
                    <br>
                    <select name="company_id" value>
                        @foreach($companies as $company)
                        <option value={{$company->id}}>
                            {{$company->name}}
                        </option>
                        @endforeach
                    </select>
                </label>
                <!-- <label class="block">
            <span class="sr-only">Introdueix un email: </span>
            <input name="email" type="text"/>
        </label>
        <label class="block">
            <span class="sr-only">Escull un arxiu</span>
            <input type="file" name="logo" class="block w-full text-sm text-slate-500
            file:mr-4 file:py-2 file:px-4
            file:rounded-full file:border-0
            file:text-sm file:font-semibold
            file:bg-violet-50 file:text-violet-700
            hover:file:bg-violet-100
            "/>
        </label> -->

                <button type="submit">Envia</button>
            </form>
        </div>
    </div>
</x-app-layout>