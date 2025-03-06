<x-app-layout>  
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <h1 class="text-3xl font-bold mb-6 flex justify-center items-center" style="font-weight:bold; margin-top:1%; font-size:1.3rem">Liste des locations en cours</h1>

        <form action="{{ route('inventorys') }}" method="GET" style="margin-bottom:2%; justify-content:center; align-items:center; display:flex;">
            <input type="text" name="search" placeholder="Rechercher un élément dans l'inventaire..." value="{{ request()->input('search') }}">
            <button type="submit" style="background-color:gray; color:white; margin-left:0.2%;" class="bg-blue-500 text-white font-bold px-6 py-2 rounded-md hover:bg-blue-600 focus:outline-none">Rechercher</button>
        </form>
        
        @if (session('success'))
            <div class="alert alert-success mb-6 text-green-600">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color: red; font-weight: bold;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($inventorys->count() === 0)
            <p class="text-center text-lg text-red-500">Aucune correspondance trouvée.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="film-list">
                @foreach ($inventorys as $inventory)
                    <div class="film-item bg-white border border-gray-200 rounded-lg shadow-md p-4">
                        <h2 class="text-xl font-semibold mb-2">{{ $inventory['title'] }}</h2>
                        <p class="text-gray-700 mb-4">{{ $inventory['address'] }}</p>
                        <a href="{{ route('inventory.show', $inventory['inventoryId']) }}" class="btn btn-primary">Voir plus</a>
                    </div>
                @endforeach
            </div>
    
            <div class="mt-6" style="margin-top:2%;">
                {{ $inventorys->links() }}
            </div>
        @endif
    </div>
</x-app-layout>