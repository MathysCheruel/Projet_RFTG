<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{
    /*
        Fonction pour afficher la liste des locations présentes en DB
    */
    public function index(Request $request)
    {
        $lien = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $API = $lien.$port;

        $searchTerm = $request->input('search', '');
        $response = Http::get($API.'/toad/rental/getInformations');
    
        if ($response->successful()) {
            $location = $response->json();
            $location = collect($location);
    
            if ($searchTerm) {
                $location = $location->filter(function ($location) use ($searchTerm) {
                    return stripos($location['title'], $searchTerm) !== false;
                });
            }

            $perPage = 12;
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $currentPageItems = $location->slice(($currentPage - 1) * $perPage, $perPage)->values();
            $paginatedLocations = new LengthAwarePaginator(
                $currentPageItems,
                $location->count(),
                $perPage,
                $currentPage,
                ['path' => $request->url(), 'query' => $request->query()]
            );
    
            return view('administration.location', ['locations' => $paginatedLocations]);
        }
    
        return redirect()->back()->withErrors('Impossible de récupérer les locations en cours');
    }
    

    /*
        Informations supplémentaires sur une location unique (Bouton "Voir Plus")
    */
    public function show($rental_id)
    {
        $lien = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $API = $lien.$port;

        $response = Http::get($API."/toad/rental/getInformations/$rental_id");
    
        if ($response->successful()) {
            $location = $response->json();
            $location = collect($location);

            return view('administration.locationshow', ['location' => $location]);
        };
        
        return redirect()->back()->withErrors('Impossible de récupérer les détails de la location');
    }
}
