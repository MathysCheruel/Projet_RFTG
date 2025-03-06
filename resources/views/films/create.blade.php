<x-app-layout>
    <div class="flex justify-center items-center min-h-screen bg-gray-50">
        <div class="w-full max-w-3xl bg-white p-8 shadow-lg rounded-md">
            <h1 class="text-2xl font-bold mb-6 text-center">Ajouter un nouveau film</h1>

            <!-- Gestion des erreurs -->
            @if ($errors->any())
                <div class="mb-4 text-red-500">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('films.store') }}" method="POST">
                @csrf

                <!-- Titre -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="title" class="block text-lg font-semibold">Titre</label>
                    <input type="text" id="title" name="title" placeholder="Le Lotus Bleu" class="mt-2 w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Description -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="description" class="block text-lg font-semibold">Description</label>
                    <textarea id="description" name="description" placeholder="Voyage à la découverte des mystères de la cité chinoise" class="mt-2 w-full p-2 border border-gray-300 rounded-md" rows="4" required></textarea>
                </div>

                <!-- Année de sortie -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="releaseYear" class="block text-lg font-semibold">Année de sortie</label>
                    <input type="number" id="releaseYear" name="releaseYear" placeholder="1936" class="mt-2 w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Langue -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="languageId" class="block text-lg font-semibold">Langue</label>
                    <input type="number" id="languageId" name="languageId" placeholder="1" class="mt-2 w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Langue originale -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="originalLanguageId" class="block text-lg font-semibold">Langue originale</label>
                    <input type="number" id="originalLanguageId" name="originalLanguageId" placeholder="1" class="mt-2 w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Durée de la location -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="rentalDuration" class="block text-lg font-semibold">Durée de location (en jours)</label>
                    <input type="number" id="rentalDuration" name="rentalDuration" placeholder="3" class="mt-2 w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Tarif de la location -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="rentalRate" class="block text-lg font-semibold">Tarif de location (€)</label>
                    <input type="number" step="0.01" id="rentalRate" name="rentalRate" placeholder="3" class="mt-2 w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Durée du film -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="length" class="block text-lg font-semibold">Durée du film (en minutes)</label>
                    <input type="number" id="length" name="length" placeholder="110" class="mt-2 w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Coût de remplacement -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="replacementCost" class="block text-lg font-semibold">Coût de remplacement (€)</label>
                    <input type="number" step="0.01" id="replacementCost" name="replacementCost" placeholder="21.99" class="mt-2 w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Classement -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="rating" class="block text-lg font-semibold">Classement</label>
                    <input type="text" id="rating" name="rating" placeholder="G+" class="mt-2 w-full p-2 border border-gray-300 rounded-md" value="" maxlength="10" required>
                </div>

                <!-- Features spéciales -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="specialfeatures" class="block text-lg font-semibold">Feature(s) spéciale(s)</label>
                    <textarea id="specialfeatures" name="specialfeatures" placeholder="Deleted Scenes" class="mt-2 w-full p-2 border border-gray-300 rounded-md" rows="4" required></textarea>
                </div>

                <!-- Bouton Enregistrer -->
                <div class="mt-6 flex justify-center">
                    <button type="submit" class="bg-blue-500 text-white font-bold px-6 py-2 rounded-md hover:bg-blue-600" style="margin-bottom:1%; background-color:gray; color:white;">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>