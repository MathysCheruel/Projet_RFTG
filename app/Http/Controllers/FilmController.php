<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class FilmController extends Controller
{

    public function index(Request $request)
    {
        $response = Http::get('http://localhost:8080/toad/film/all');
    
        if ($response->successful()) {
            $films = collect($response->json())->map(function ($film) {
                return [
                    'id' => $film['filmId'],
                    'title' => $film['title'],
                    'description' => $film['description'],
                    'releaseYear' => $film['releaseYear'],
                    'languageId' => $film['languageId'],
                    'originalLanguageId' => $film['originalLanguageId'],
                    'rentalDuration' => $film['rentalDuration'],
                    'rentalRate' => $film['rentalRate'],
                    'length' => $film['length'],
                    'replacementCost' => $film['replacementCost'],
                    'rating' => $film['rating'],
                    'idDirector' => $film['idDirector']
                ];
            });
    
            $perPage = 10;
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $currentPageItems = $films->slice(($currentPage - 1) * $perPage, $perPage)->values();
            $paginatedFilms = new LengthAwarePaginator(
                $currentPageItems,
                $films->count(),
                $perPage,
                $currentPage,
                ['path' => $request->url(), 'query' => $request->query()]
            );
    
            return view('films.catalogue', ['films' => $paginatedFilms]);
        }
    
        return redirect()->back()->withErrors('Impossible de récupérer les films');
    }
    
    public function show($id)
    {
        $response = Http::get("http://localhost:8080/toad/film/getById?id=$id");
    
        if ($response->successful()) {
            $film = $response->json();
            return view('films.show', ['film' => $film]);
        };
        
        return redirect()->back()->withErrors('Impossible de récupérer les détails du film');
    }

    public function destroy($id){
        $response = Http::delete("http://localhost:8080/toad/film/delete/{$id}");

        if ($response->successful()) {
            return redirect()->route('catalogue')->with('success', 'Film supprimé avec succès.');
        }
       
        return redirect()->back()->withErrors('Impossible de supprimer le film.');
    }

    public function edit($id)
    {
        // Récupérer les détails du film à éditer
        $response = Http::get("http://localhost:8080/toad/film/getById?id=$id");

        // Vérifier si la requête a réussi
        if ($response->successful()) {
            $film = $response->json();
            return view('films.edit', ['film' => $film]);
        }

        return redirect()->back()->withErrors('Impossible de récupérer les détails du film à éditer');
    }
    
    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'releaseYear' => 'required|integer',
            'languageId' => 'required|integer',
            'originalLanguageId' => 'required|integer',
            'rentalDuration' => 'required|integer',
            'rentalRate' => 'required|numeric',
            'length' => 'required|integer',
            'replacementCost' => 'required|numeric',
            'rating' => 'required|string|max:10',
            'idDirector' => 'nullable|integer',
        ]);
    
        // Générer l'horodatage actuel pour lastUpdate
        $lastUpdate = Carbon::now()->format('Y-m-d H:i:s'); // Format attendu : 'YYYY-MM-DD HH:MM:SS'
    
        // Ajouter lastUpdate aux données validées
        $validated['lastUpdate'] = $lastUpdate;
    
        // Effectuer la requête PUT avec les données encodées en URL
        $response = Http::asForm()->put("http://localhost:8080/toad/film/update/$id", $validated);
    
        // Vérifier si la mise à jour a réussi
        if ($response->successful()) {
            return redirect()->route('catalogue')->with('success', 'Film mis à jour avec succès.');
        }
    
        // Retourner l'erreur avec le message de l'API
        return redirect()->back()->withErrors('Erreur lors de la mise à jour du film : ' . $response->body());
    }    

}
