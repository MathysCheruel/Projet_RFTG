<?php

namespace App\Http\Controllers;

use App\Models\Film;
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

    public function edit($id){

    }
}
