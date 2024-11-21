<x-app-layout>
    <div class="flex justify-center items-center min-h-screen bg-gray-50">
        <div class="w-full">
            <form method="POST" action="{{ route('films.destroy', $film['filmId']) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce film ?')">
                    @csrf
                    @method('DELETE')    
                <button type="submit" class="px-4 py-2 rounded-md" style="background-color:red; color:white; margin-left:5%; margin-bottom:2%;">
                    Supprimer
                </button>
            </form>
            <a type="submit" href="{{ route('films.edit', ['id' => $film['filmId']]) }}" class="px-4 py-2 rounded-md" style="background-color:gray; color:white; margin-bottom:2%;">
                Editer
            </a>
            <h1 class="text-6xl title-bold mb-6 text-center" style="font-weight:bold;">{{ $film['title'] ?? 'Titre non disponible' }}</h1>

            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Description :</strong> {{ $film['description'] ?? 'Description non disponible' }}</p>
            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Année de sortie :</strong> {{ $film['releaseYear'] ?? 'N/A' }}</p>
            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Durée de location :</strong> {{ $film['rentalDuration'] ?? 'N/A' }} jours</p>
            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Tarif de location :</strong> {{ $film['rentalRate'] ?? 'N/A' }} €</p>
            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Durée du film :</strong> {{ $film['length'] ?? 'N/A' }} minutes</p>
            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Coût de remplacement :</strong> {{ $film['replacementCost'] ?? 'N/A' }} €</p>
            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Classement :</strong> {{ $film['rating'] ?? 'Non classé' }}</p>
            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Langue originale :</strong> {{ $film['originalLanguageId'] ?? 'N/A' }}</p>

            @if (!empty($film['specialFeatures']))
                <p class="text-gray-700 mb-4 text-lg text-center"><strong>Caractéristiques spéciales :</strong> {{ $film['specialFeatures'] }}</p>
            @endif

            @if (!empty($film['idDirector']))
                <p class="text-gray-700 mb-4 text-lg text-center"><strong>Réalisateur :</strong> {{ $film['idDirector'] }}</p>
            @else
                <p class="text-gray-700 mb-4 text-lg text-center"><strong>Réalisateur :</strong> Non spécifié</p>
            @endif
        </div>
    </div>

    
</x-app-layout>
