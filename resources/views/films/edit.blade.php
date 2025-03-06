<x-app-layout>
    <div class="flex justify-center items-center min-h-screen bg-gray-50">
        <div class="w-full">
            <h1 class="text-4xl font-bold mb-6 text-center" style="font-weight:bold; margin-top:2%; font-size:1.3rem">Éditer le Film : {{ $film['title'] }}</h1>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color: red; font-weight: bold;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('films.update', ['id' => $film['filmId']]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="flex justify-center">
                    <button type="submit" class="bg-blue-500 text-white font-bold px-6 py-2 rounded-md hover:bg-blue-600 focus:outline-none" style="margin-bottom:1%; background-color:gray; color:white;">
                        Sauvegarder
                    </button>
                </div>

                <!-- Titre -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="title" class="block text-lg font-semibold">Titre</label>
                    <input type="text" id="title" name="title" class="mt-2 w-full p-2 border border-gray-300 rounded-md" value="{{ old('title', $film['title']) }}" required>
                </div>

                <!-- Description -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="description" class="block text-lg font-semibold">Description</label>
                    <textarea id="description" name="description" class="mt-2 w-full p-2 border border-gray-300 rounded-md" rows="4" required>{{ old('description', $film['description']) }}</textarea>
                </div>

                <!-- Année de sortie -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="releaseYear" class="block text-lg font-semibold">Année de sortie</label>
                    <input type="number" id="releaseYear" name="releaseYear" class="mt-2 w-full p-2 border border-gray-300 rounded-md" value="{{ old('releaseYear', $film['releaseYear']) }}" required>
                </div>

                <!-- Langue disponible (traduction) -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="languageId" class="block text-lg font-semibold">Langue</label>
                    <input type="number" id="languageId" name="languageId" class="mt-2 w-full p-2 border border-gray-300 rounded-md" value="{{ old('languageId', $film['languageId']) }}" required>
                </div>

                <!-- Langue originale -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="originalLanguageId" class="block text-lg font-semibold">Langue originale</label>
                    <input type="number" id="originalLanguageId" name="originalLanguageId" class="mt-2 w-full p-2 border border-gray-300 rounded-md" value="{{ old('originalLanguageId', $film['originalLanguageId']) }}" required>
                </div>

                <!-- Durée de la location -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="rentalDuration" class="block text-lg font-semibold">Durée de location (en jours)</label>
                    <input type="number" id="rentalDuration" name="rentalDuration" class="mt-2 w-full p-2 border border-gray-300 rounded-md" value="{{ old('rentalDuration', $film['rentalDuration']) }}" required>
                </div>

                <!-- Tarif de la location -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="rentalRate" class="block text-lg font-semibold">Tarif de location (€)</label>
                    <input type="number" step="0.01" id="rentalRate" name="rentalRate" class="mt-2 w-full p-2 border border-gray-300 rounded-md" value="{{ old('rentalRate', $film['rentalRate']) }}" required>
                </div>

                <!-- Durée du film -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="length" class="block text-lg font-semibold">Durée du film (en minutes)</label>
                    <input type="number" id="length" name="length" class="mt-2 w-full p-2 border border-gray-300 rounded-md" value="{{ old('length', $film['length']) }}" required>
                </div>

                <!-- Coût de remplacement -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="replacementCost" class="block text-lg font-semibold">Coût de remplacement (€)</label>
                    <input type="number" step="0.01" id="replacementCost" name="replacementCost" class="mt-2 w-full p-2 border border-gray-300 rounded-md" value="{{ old('replacementCost', $film['replacementCost']) }}" required>
                </div>

                <!-- Classement -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="rating" class="block text-lg font-semibold">Classement</label>
                    <input type="text" id="rating" name="rating" class="mt-2 w-full p-2 border border-gray-300 rounded-md" value="{{ old('rating', $film['rating']) }}" maxlength="10" required>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
