<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class FilmController extends Controller
{
    /*
        Fonction pour afficher la liste des films présents en DB
    */
    public function index(Request $request)
    {
        $lien = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $API = $lien.$port;
        $searchTerm = $request->input('search', '');
        $response = Http::get($API.'/toad/film/all');
        $responseStock = Http::get($API.'/toad/inventory/stockFilm');
    
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
                    'rating' => $film['rating']
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
        } 
        if($responseStock->successful()){
            $stockData = collect($responseStock->json())->mapWithKeys(fn ($stockItem) => [
                $stockItem['filmId'] => $stockItem['filmsDisponibles']
            ]);
            return view('films.catalogue', ['films' => $paginatedFilms, 'stockData' => $stockData]);
        }
    
        return redirect()->back()->withErrors('Impossible de récupérer les films');
    }
    

    /*
        Informations supplémentaires sur un film unique (Bouton "Voir Plus")
    */
    public function show($id)
    {
        $lien = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $API = $lien.$port;
        $response = Http::get($API."/toad/film/getById?id=$id");
    
        if ($response->successful()) {
            $film = $response->json();
            return view('films.show', ['film' => $film]);
        };
        
        return redirect()->back()->withErrors('Impossible de récupérer les détails du film');
    }

    /*
        Supprimer un film unique
    */
    public function destroy($id){
        $lien = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $API = $lien.$port;
        $response = Http::delete($API."/toad/film/delete/{$id}");

        if ($response->successful()) {
            return redirect()->route('catalogue')->with('success', 'Film supprimé avec succès.');
        }
       
        return redirect()->back()->withErrors('Impossible de supprimer le film.');
    }

    /*
        Récupérer les informations d'un film unique
    */
    public function edit($id)
    {
        $lien = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $API = $lien.$port;
        $response = Http::get($API."/toad/film/getById?id=$id");

        if ($response->successful()) {
            $film = $response->json();
            return view('films.edit', ['film' => $film]);
        }

        return redirect()->back()->withErrors('Impossible de récupérer les détails du film à éditer');
    }
    
    /*
        Mettre à jour les informations d'un film
    */
    public function update(Request $request, $id)
    {
        $lien = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $API = $lien.$port;

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
            'rating' => 'required|string|max:10'
        ]);
    
        $lastUpdate = Carbon::now()->format('Y-m-d H:i:s'); // Format attendu : 'YYYY-MM-DD HH:MM:SS'
    
        $validated['lastUpdate'] = $lastUpdate;
    
        $response = Http::asForm()->put($API."/toad/film/update/$id", $validated);
    
        if ($response->successful()) {
            return redirect()->route('catalogue')->with('success', 'Film mis à jour avec succès.');
        }
    
        return redirect()->back()->withErrors('Erreur lors de la mise à jour du film');
    }    
    
    public function create()
    {
        return view('films.create');
    }
    
    /*
        Créer un DVD
    */
    public function store(Request $request)
    {
        $lien = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $API = $lien.$port;

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
            'specialfeatures' => 'required|string'
        ]);
    
        $lastUpdate = Carbon::now()->format('Y-m-d H:i:s'); // Format attendu : 'YYYY-MM-DD HH:MM:SS'
    
        $validated['lastUpdate'] = $lastUpdate;

        $response = Http::asForm()->post($API."/toad/film/add", $validated);
        Log::info('Requete API : '.$response);

        if ($response->successful()) {
            return redirect()->route('catalogue')->with('success', 'Film ajouté avec succès.');
        }
    
        return redirect()->back()->withErrors("Erreur lors de l'ajout à jour du film");
    }
    
}
