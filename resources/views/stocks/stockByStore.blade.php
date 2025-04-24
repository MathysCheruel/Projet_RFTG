<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            📀 Stock par magasin
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach($films as $film)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-700">
                            🎬 {{ $film['title'] }} <span class="text-sm text-gray-500">(ID: {{ $film['filmId'] }})</span>
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">
                            Total en stock : 
                            <span class="font-bold text-indigo-600">{{ $film['totalQuantity'] }} DVD</span>
                        </p>
                    </div>

                    <div class="px-6 py-4">
                        <ul class="list-disc list-inside text-gray-700 space-y-1 mb-4">
                            @foreach($film['stores'] as $store)
                                <li>
                                    🏬 Magasin <span class="font-medium">#{{ $store['storeId'] }}</span> :
                                    <span class="text-indigo-600 font-semibold">{{ $store['quantity'] }} DVD</span>
                                </li>
                            @endforeach
                        </ul>

                        {{-- Formulaire d’ajout d’un stock pour ce film --}}
                        <div class="mt-4 border-t pt-4">
                            <h4 class="text-md font-semibold text-gray-700 mb-2">➕ Ajouter un stock pour ce film :</h4>
                            <form action="{{ route('stocks.store') }}" method="POST" class="flex flex-col sm:flex-row gap-4">
                                @csrf
                                <input type="hidden" name="film_id" value="{{ $film['filmId'] }}">

                                <div>
                                    <label for="store_id" class="block text-sm font-medium text-gray-700">Magasin ID :</label>
                                    <input type="number" name="store_id" required
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>

                                <div class="flex items-end">
                                    <button type="submit"
                                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md" style="background-color:blue; color:white;">
                                        Ajouter
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
