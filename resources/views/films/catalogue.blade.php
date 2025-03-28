<x-app-layout>  
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16 bg-gray-50">
        <!-- Titre -->
        <h1 class="text-4xl font-extrabold text-center text-black mb-10">
            Découvrez notre <span class="text-indigo-600">Catalogue de Films</span>
        </h1>

        <!-- Barre de Recherche -->
        <form action="{{ route('catalogue') }}" method="GET" class="flex justify-center items-center mb-10" style="margin-top: 2%;">
            <input type="text" name="search" placeholder="Rechercher un film..."
                value="{{ request()->input('search') }}"
                class="w-2/3 p-4 text-lg rounded-lg bg-black text-black placeholder-gray-500 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
            <button type="submit" class="bg-indigo-600 text-black font-semibold px-6 py-3 rounded-lg ml-4 transition-all hover:bg-indigo-700 focus:outline-none">
                🔍 Rechercher
            </button>
        </form>

        <!-- Ajouter un film -->
        <div class="flex justify-center mb-12" style="margin-top: 2%;">
            <a href="{{ route('films.create') }}" class="px-4 py-2 rounded-md" style="background-color:maroon; color:white;">
                Ajouter un Film
            </a>
        </div>

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

        <!-- Aucun film trouvé -->
        @if ($films->count() === 0)
            <p class="text-center text-xl text-gray-500">Aucun film trouvé.</p>
        @else
            <!-- Liste des films -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8" style="margin-top: 2%;">
                @foreach ($films as $film)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all transform hover:scale-105 hover:shadow-lg mb-8 gap-6" style="margin-top: 0.5%;">
                        <div class="p-6">
                            <h2 class="text-2xl font-semibold text-black mb-4">{{ $film['title'] }}</h2>
                            <p class="text-black mb-4">{{ Str::limit($film['description'], 100) }}</p>
                            <p class="text-black mb-4">Quantité disponible : <strong>{{ $stockData[$film['id']] ?? 'N/A' }}</strong></p>
                            <a href="{{ route('show', $film['id']) }}" class="px-4 py-2 rounded-md" style="background-color:blue; color:white;">
                                Voir plus
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 text-center">
                {{ $films->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
