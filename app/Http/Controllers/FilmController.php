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
    /*
        Fonction pour afficher la liste des films
    */
    public function index(Request $request)
    {
        $searchTerm = $request->input('search', ''); // Valeur par défaut vide
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
    
            if ($searchTerm) {
                $films = $films->filter(function ($film) use ($searchTerm) {
                    return stripos($film['title'], $searchTerm) !== false;
                });
            }

            $perPage = 12;
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
    

    /*
        Informations supplémentaires sur le film (Bouton "Voir Plus")
    */
    public function show($id)
    {
        $response = Http::get("http://localhost:8080/toad/film/getById?id=$id");
    
        if ($response->successful()) {
            $film = $response->json();
            return view('films.show', ['film' => $film]);
        };
        
        return redirect()->back()->withErrors('Impossible de récupérer les détails du film');
    }

    /*
        Supprimer un film
    */
    public function destroy($id){
        $response = Http::delete("http://localhost:8080/toad/film/delete/{$id}");

        if ($response->successful()) {
            return redirect()->route('catalogue')->with('success', 'Film supprimé avec succès.');
        }
       
        return redirect()->back()->withErrors('Impossible de supprimer le film.');
    }

    /*
        Modifier les informations d'un film
    */
    public function edit($id)
    {
        $response = Http::get("http://localhost:8080/toad/film/getById?id=$id");

        if ($response->successful()) {
            $film = $response->json();
            return view('films.edit', ['film' => $film]);
        }

        return redirect()->back()->withErrors('Impossible de récupérer les détails du film à éditer');
    }
    
    public function update(Request $request, $id)
    {
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
    
        $lastUpdate = Carbon::now()->format('Y-m-d H:i:s'); // Format attendu : 'YYYY-MM-DD HH:MM:SS'
    
        $validated['lastUpdate'] = $lastUpdate;
    
        $response = Http::asForm()->put("http://localhost:8080/toad/film/update/$id", $validated);
    
        if ($response->successful()) {
            return redirect()->route('catalogue')->with('success', 'Film mis à jour avec succès.');
        }
    
        return redirect()->back()->withErrors('Erreur lors de la mise à jour du film : ' . $response->body());
    }    

}
