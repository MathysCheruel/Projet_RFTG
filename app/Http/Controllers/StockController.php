<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

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
}
