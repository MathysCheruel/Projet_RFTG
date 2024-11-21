<!-- resources/views/films/catalogue.blade.php -->
<x-app-layout>  
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <h1 class="text-3xl font-bold mb-6">Catalogue de Films</h1>
 
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color: red; font-weight: bold;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($films as $film)
                <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                    <h2 class="text-xl font-semibold mb-2">{{ $film['title'] }}</h2>
                    <p class="text-gray-700 mb-4">{{ Str::limit($film['description'], 100) }}</p>
                    <a href="{{ route('show', $film['id']) }}" class="btn btn-primary">Voir plus</a>
                </div>
            @endforeach
        </div>
 
        <div class="mt-6">
            {{ $films->links() }}
        </div>
    </div>
</x-app-layout>
