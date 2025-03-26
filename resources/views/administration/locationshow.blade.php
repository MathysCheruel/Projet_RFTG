<x-app-layout>
    
    <div class="min-h-screen bg-gray-50" style="width:100%">
        <div class="w-full bg-gray-50">
            <div class="flex justify-center items-center w-full">
            @php 
                $rental = $location->first(); 
            @endphp
            </div>
            <h1 class="text-6xl title-bold mb-6 text-center" style="font-weight:bold; font-size:1.3rem; margin-bottom:4%;">Location du film : {{ $rental['title'] ?? 'Titre indisponible' }}</h1>

            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Date de location :</strong> {{ $rental['rental_date'] ?? 'Date de location indisponible' }}</p>
            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Prénom du locataire :</strong> {{ $rental['customer_firstname'] ?? 'Prénom du locataire indisponible' }}</p>
            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Nom du locataire :</strong> {{ $rental['customer_lastname'] ?? 'Nom de famille du locataire indisponible' }}</p>
            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Date de retour :</strong> {{ $rental['return_date'] ?? 'Date de retour indisponible' }}</p>
            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Prénom staff :</strong> {{ $rental['staff_firstname'] ?? 'Prénom du staff indisponible' }}</p>
            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Nom staff :</strong> {{ $rental['staff_lastname'] ?? 'Nom de famille du staff indisponible' }}</p>
            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Dernière date de modification :</strong> {{ $rental['last_update'] ?? 'Dernière date de modification indisponible' }}</p>
        </div>
    </div>
    
</x-app-layout>
