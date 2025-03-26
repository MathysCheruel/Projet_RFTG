<x-app-layout>
    <div class="flex justify-center items-center min-h-screen bg-gray-50">
        <div class="w-full max-w-3xl bg-white p-8 shadow-lg rounded-md">
            <h1 class="text-2xl font-bold mb-6 text-center">Ajouter un nouveau client</h1>

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

            <form action="{{ route('customer.store') }}" method="POST">
                @csrf

                <div class="flex justify-center">
                    <button type="submit" class="bg-blue-500 text-white font-bold px-6 py-2 rounded-md hover:bg-blue-600 focus:outline-none" style="margin-bottom:1%; background-color:gray; color:white;">
                        Sauvegarder
                    </button>
                </div>

                <!-- Email -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="email" class="block text-lg font-semibold">Email</label>
                    <input type="email" id="email" name="email" class="mt-2 w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Prénom -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="first_name" class="block text-lg font-semibold">Prénom</label>
                    <input type="text" id="first_name" name="first_name" class="mt-2 w-full p-2 border border-gray-300 rounded-md" required></input>
                </div>

                <!-- Nom -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="last_name" class="block text-lg font-semibold">Nom</label>
                    <input type="text" id="last_name" name="last_name" class="mt-2 w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Adresse -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="address_id" class="block text-lg font-semibold">addressId</label>
                    <input type="number" id="address_id" name="address_id" class="mt-2 w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Store Id -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="store_id" class="block text-lg font-semibold">storeId</label>
                    <input type="number" id="store_id" name="store_id" class="mt-2 w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Mot de passe  -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="password" class="block text-lg font-semibold">Mot de passe</label>
                    <input type="number" id="password" name="password" class="mt-2 w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Âge -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="age" class="block text-lg font-semibold">Age</label>
                    <input type="number" step="1" id="age" name="age" class="mt-2 w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Actif -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="active" class="block text-lg font-semibold">Active</label>
                    <input type="number" step="1" id="active" name="active" class="mt-2 w-full p-2 border border-gray-300 rounded-md" required>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>