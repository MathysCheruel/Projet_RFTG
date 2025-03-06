<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class InventoryController extends Controller
{
        /*
        Fonction pour afficher la liste des elements de l'inventaire présentes en DB
    */
    public function index(Request $request)
    {
        $searchTerm = $request->input('search', '');
        $response = Http::get('http://localhost:8080/toad/inventory/getStockByStore');
    
        if ($response->successful()) {
            $inventory = $response->json();
            $inventory = collect($inventory);
    
            if ($searchTerm) {
                $inventory = $inventory->filter(function ($inventory) use ($searchTerm) {
                    return stripos($inventory['inventoryId'], $searchTerm) !== false;
                });
            }

            $perPage = 12;
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $currentPageItems = $inventory->slice(($currentPage - 1) * $perPage, $perPage)->values();
            $paginatedInventory = new LengthAwarePaginator(
                $currentPageItems,
                $inventory->count(),
                $perPage,
                $currentPage,
                ['path' => $request->url(), 'query' => $request->query()]
            );
    
            return view('administration.inventory', ['inventorys' => $paginatedInventory]);
        }
    
        return redirect()->back()->withErrors("Impossible de récupérer les occurences de l'inventaire");
    }
    

    /*
        Informations supplémentaires sur une occurence de notre inventaire unique (Bouton "Voir Plus")
    */
    public function show($id)
    {
        $response = Http::get("http://localhost:8080/toad/inventory/getStockByStore");
    
        if ($response->successful()) {
            $inventory = $response->json();
            return view('administration.inventoryshow', ['inventory' => $inventory]);
        };
        
        return redirect()->back()->withErrors("Impossible de récupérer les détails de l'occurence de l'inventaire");
    }
}
