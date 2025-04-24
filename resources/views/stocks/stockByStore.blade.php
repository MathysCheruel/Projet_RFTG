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
                            Total en stock : <span class="font-bold text-indigo-600">{{ $film['totalQuantity'] }} DVD</span>
                        </p>
                    </div>
                    <div class="px-6 py-4">
                        <ul class="list-disc list-inside text-gray-700">
                            @foreach($film['stores'] as $store)
                                <li>
                                    🏬 Magasin <span class="font-medium">#{{ $store['storeId'] }}</span> :
                                    <span class="text-indigo-600 font-semibold">{{ $store['quantity'] }} DVD</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
