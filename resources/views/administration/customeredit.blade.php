<x-app-layout>
    <div class="flex justify-center items-center min-h-screen bg-gray-50">
        <div class="w-full">
            <h1 class="text-4xl font-bold mb-6 text-center" style="font-weight:bold; margin-top:2%; font-size:1.3rem">Éditer le client : {{ $client['firstName'] }}</h1>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color: red; font-weight: bold;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('customer.update', ['id' => $client['customerId']]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="flex justify-center">
                    <button type="submit" class="bg-blue-500 text-white font-bold px-6 py-2 rounded-md hover:bg-blue-600 focus:outline-none" style="margin-bottom:1%; background-color:gray; color:white;">
                        Sauvegarder
                    </button>
                </div>

                <!-- Email -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="email" class="block text-lg font-semibold">Email</label>
                    <input type="email" id="email" name="email" class="mt-2 w-full p-2 border border-gray-300 rounded-md" value="{{ old('email', $client['email']) }}" required>
                </div>

                <!-- Prénom -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="firstName" class="block text-lg font-semibold">Prénom</label>
                    <input type="text" id="firstName" name="firstName" class="mt-2 w-full p-2 border border-gray-300 rounded-md" value="{{ old('firstName', $client['firstName']) }}" required></input>
                </div>

                <!-- Nom -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="lastName" class="block text-lg font-semibold">Nom</label>
                    <input type="text" id="lastName" name="lastName" class="mt-2 w-full p-2 border border-gray-300 rounded-md" value="{{ old('lastName', $client['lastName']) }}" required>
                </div>

                <!-- Adresse -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="addressId" class="block text-lg font-semibold">addressId</label>
                    <input type="number" id="addressId" name="addressId" class="mt-2 w-full p-2 border border-gray-300 rounded-md" value="{{ old('addressId', $client['addressId']) }}" required>
                </div>

                <!-- Store Id -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="storeId" class="block text-lg font-semibold">storeId</label>
                    <input type="number" id="storeId" name="storeId" class="mt-2 w-full p-2 border border-gray-300 rounded-md" value="{{ old('storeId', $client['storeId']) }}" required>
                </div>

                <!-- Mot de passe  -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="password" class="block text-lg font-semibold">Mot de passe</label>
                    <input type="text" id="password" name="password" class="mt-2 w-full p-2 border border-gray-300 rounded-md" value="{{ old('password', $client['password']) }}" required>
                </div>

                <!-- Âge -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="age" class="block text-lg font-semibold">Age</label>
                    <input type="number" step="1" id="age" name="age" class="mt-2 w-full p-2 border border-gray-300 rounded-md" value="{{ old('age', $client['age']) }}" required>
                </div>

                <!-- Actif -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="active" class="block text-lg font-semibold">Active</label>
                    <input type="number" step="1" id="active" name="active" class="mt-2 w-full p-2 border border-gray-300 rounded-md" value="{{ old('active', $client['active']) }}" required>
                </div>

                <!-- Actif -->
                <div class="mb-4" style="margin-left:10%; margin-right:10%;">
                    <label for="createDate" class="block text-lg font-semibold" readonly="readonly">Date de création</label>
                    <input type="text" step="1" id="createDate" name="createDate" class="mt-2 w-full p-2 border border-gray-300 rounded-md" value="{{ old('createDate', $client['createDate']) }}" readonly required>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
