<x-app-layout>  
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16 bg-gray-50">
        <h1 class="text-4xl font-extrabold text-center text-black mb-10">
            Liste des <span class="text-indigo-600">locations en cours</span>
        </h1>

        <!-- Barre de Recherche -->
        <form action="{{ route('locations') }}" method="GET" class="flex justify-center items-center mb-10" style="margin-top: 2%;">
            <input type="text" name="search" placeholder="Rechercher une location..."
                value="{{ request()->input('search') }}"
                class="w-2/3 p-4 text-lg rounded-lg bg-black text-black placeholder-gray-500 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
            <button type="submit" class="bg-indigo-600 text-black font-semibold px-6 py-3 rounded-lg ml-4 transition-all hover:bg-indigo-700 focus:outline-none">
                🔍 Rechercher
            </button>
        </form>
        
        <!-- Messages d'alerte -->
        @if (session('success'))
            <div class="text-center text-green-500 font-medium mb-6">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="text-center text-red-500 font-medium mb-6">
                @foreach ($errors->all() as $error)
                    ⚠️ {{ $error }}<br>
                @endforeach
            </div>
        @endif

        @if ($locations->count() === 0)
            <p class="text-center text-xl text-gray-500">Aucune correspondance trouvée.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8" style="margin-top: 2%;">
                @foreach ($locations as $location)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all transform hover:scale-105 hover:shadow-lg mb-8 gap-6" style="margin-top: 0.5%;">
                        <div class="p-6">    
                            <h2 class="text-2xl font-semibold text-black mb-4">{{ $location['title'] }}</h2>
                            <p class="text-black mb-4">{{ $location['return_date'] }}</p>
                            <a href="{{ route('locations.show', $location['rental_id']) }}" class="px-4 py-2 rounded-md" style="background-color:blue; color:white;">
                                Voir plus
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
    
            <div class="mt-6" style="margin-top:2%;">
                {{ $locations->links() }}
            </div>
        @endif
    </div>
</x-app-layout>