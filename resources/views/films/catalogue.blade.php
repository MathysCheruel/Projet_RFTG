<!-- resources/views/films/catalogue.blade.php -->
<x-app-layout>  
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <h1 class="text-3xl font-bold mb-6">Catalogue de Films</h1>
 
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($films as $film)
                <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                    <h2 class="text-xl font-semibold mb-2">{{ $film['title'] }}</h2>
                    <p class="text-gray-700 mb-4">{{ Str::limit($film['description'], 100) }}</p>
                    <button class="bg-black text-black px-4 py-2 rounded">Voir plus</button>
                </div>
            @endforeach
        </div>
 
        <div class="mt-6">
            {{ $films->links() }}
        </div>
    </div>
</x-app-layout>