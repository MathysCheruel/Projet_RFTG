<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class StockController extends Controller
{
    public function showStockByStore()
    {
        $lien = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $API = $lien.$port;
        $response = Http::get($API.'/toad/inventory/getStockByStore');
    
        if (!$response->successful()) {
            abort(500, 'Erreur lors de la récupération des données.');
        }
    
        $data = collect($response->json());
    
        $groupedByFilm = $data->groupBy('filmId')->map(function ($items) {
            $title = $items->first()['title'];
            $totalQuantity = $items->sum('quantity');
    
            $stores = $items->map(function ($item) {
                return [
                    'storeId' => $item['storeId'],
                    'quantity' => $item['quantity'],
                    'inventory_id' => $item['filmId'] . '-' . $item['storeId'],
                ];
            });
    
            return [
                'filmId' => $items->first()['filmId'],
                'title' => $title,
                'totalQuantity' => $totalQuantity,
                'stores' => $stores->values(),
            ];
        })->values();
    
        return view('stocks.stockByStore', ['films' => $groupedByFilm]);
    }    

    public function store(Request $request)
    {
        $filmId = (int) $request->film_id;
        $storeId = (int) $request->store_id;
        $lastUpdate = Carbon::now()->toDateTimeString();
    
        $lien = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $API = $lien.$port;
    
        $lastUpdate = now()->format('Y-m-d H:i:s');

        $response = Http::asForm()->post($API.'/toad/inventory/add', [
            'film_id' => $filmId,
            'store_id' => $storeId,
            'last_update' => $lastUpdate,
        ]);
    
        if ($response->successful()) {
            return back()->with('success', $response->body());
        } else {
            return back()->with('error', 'Erreur lors de l\'ajout du stock. Code : ' . $response->status());
        }
    }    
    
}
