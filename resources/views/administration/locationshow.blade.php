<x-app-layout>
    
    <div class="min-h-screen bg-gray-50" style="width:100%">
        <div class="w-full bg-gray-50">
            <div class="flex justify-center items-center w-full">
            
            </div>
            <h1 class="text-6xl title-bold mb-6 text-center" style="font-weight:bold; font-size:1.3rem; margin-bottom:4%;">Location n° {{ $location['rentalId'] ?? 'Id indisponible' }}</h1>

            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Date de location :</strong> {{ $location['rentalDate'] ?? 'Date de location indisponible' }}</p>
            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Nom du film loué :</strong> {{ $location['inventoryId'] ?? 'Id d inventaire indisponible' }}</p>
            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Nom du locataire :</strong> {{ $location['customerId'] ?? 'Id du locataire indisponible' }}</p>
            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Date de retour :</strong> {{ $location['returnDate'] ?? 'Date de retour indisponible' }}</p>
            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Nom du loueur :</strong> {{ $location['staffId'] ?? 'Id du loueur indisponible' }}</p>
            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Dernière date de modification :</strong> {{ $location['lastUpdate'] ?? 'Dernière date de modification indisponible' }}</p>
        </div>
    </div>
    
</x-app-layout>
