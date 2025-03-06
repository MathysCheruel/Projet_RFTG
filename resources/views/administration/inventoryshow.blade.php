<x-app-layout>
    
    <div class="min-h-screen bg-gray-50" style="width:100%">
        <div class="w-full bg-gray-50">
            <div class="flex justify-center items-center w-full">
            
            </div>
            <h1 class="text-6xl title-bold mb-6 text-center" style="font-weight:bold; font-size:1.3rem; margin-bottom:4%;">Titre du film : {{ $inventory['title'] ?? 'Titre indisponible' }}</h1>

            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Quantité :</strong> {{ $inventory['quantity'] ?? 'Quantité indisponible' }}</p>
            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Informations du store :</strong> {{ $inventory['storeId'] ?? 'Informations du store indisponible' }}</p>
            <p class="text-gray-700 mb-4 text-lg text-center"><strong>Adresse :</strong> {{ $inventory['address'] ?? 'Adresse indisponible' }}</p>
            <p class="text-gray-700 mb-4 text-lg text-center"><strong>District :</strong> {{ $inventory['district'] ?? 'District indisponible' }}</p>
        </div>
    </div>
    
</x-app-layout>
