<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

class CustomerController extends Controller
{
    //

    public function index(Request $request) {
        $lien = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $API = $lien.$port;

        $searchTerm = $request->input('search', '');
        $response = Http::get($API.'/toad/customer/all');
    
        if ($response->successful()) {
            $clients = $response->json();
            $clients = collect($clients);
    
            if ($searchTerm) {
                $clients = $clients->filter(function ($clients) use ($searchTerm) {
                    return stripos($clients['firstName'], $searchTerm) !== false;
                });
            }

            $perPage = 12;
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $currentPageItems = $clients->slice(($currentPage - 1) * $perPage, $perPage)->values();
            $paginatedClients = new LengthAwarePaginator(
                $currentPageItems,
                $clients->count(),
                $perPage,
                $currentPage,
                ['path' => $request->url(), 'query' => $request->query()]
            );
    
            return view('administration.customer', ['clients' => $paginatedClients]);
        }
    
        return redirect()->back()->withErrors("Impossible de récupérer la liste des clients");
    }

    public function store(Request $request) {
        $lien = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $API = $lien.$port;

        $validated = $request->validate([
            'store_id' => 'required|integer',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string',
            'address_id' => 'required|integer',
            'password' => 'required|integer',
            'age' => 'required|integer',
            'active' => 'required|integer',
        ]);
    
        $lastUpdate = Carbon::now()->format('Y-m-d H:i:s'); // Format attendu : 'YYYY-MM-DD HH:MM:SS'
        $createUpdate = Carbon::now()->format('Y-m-d H:i:s');
    
        $validated['last_update'] = $lastUpdate;
        $validated['create_update'] = $createUpdate;

        $response = Http::asForm()->post($API."/toad/customer/add", $validated);

        if ($response->successful()) {
            return redirect()->route('customer.show')->with('success', 'Client ajouté avec succès.');
        }
    
        return redirect()->back()->withErrors("Erreur lors de l'ajout du client");
    }

    public function create(Request $request) {
        return view('administration.customercreate');
    }

    public function update(Request $request, $id) {
        $lien = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $API = $lien.$port;

        $validated = $request->validate([
            'storeId' => 'required|integer',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|string',
            'addressId' => 'required|integer',
            'password' => 'required|string',
            'age' => 'required|integer',
            'active' => 'required|integer',
            'createDate' => 'required|date'
        ]);
    
        $validated['createDate'] = \Carbon\Carbon::parse($validated['createDate'])->format('Y-m-d H:i:s');
        $lastUpdate = Carbon::now()->format('Y-m-d H:i:s'); // Format attendu : 'YYYY-MM-DD HH:MM:SS'
        $createUpdate = Carbon::now()->format('Y-m-d H:i:s');
    
        $validated['lastUpdate'] = $lastUpdate;
        $validated['createUpdate'] = $createUpdate;
    
        $response = Http::asForm()->put($API."/toad/customer/update/$id", $validated);
    
        if ($response->successful()) {
            return redirect()->route('customer.show')->with('success', 'Client mis à jour avec succès.');
        }
    
        return redirect()->back()->withErrors('Erreur lors de la mise à jour du client');
    }

    public function destroy($id) {
        $lien = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $API = $lien.$port;
        $response = Http::delete($API."/toad/customer/delete/{$id}");

        if ($response->successful()) {
            return redirect()->route('customer.show')->with('success', 'Client supprimé avec succès.');
        }
       
        return redirect()->back()->withErrors('Impossible de supprimer le client.');
    }

    public function edit($id) {
        $lien = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $API = $lien.$port;
        $response = Http::get($API."/toad/customer/getById?id=$id");

        if ($response->successful()) {
            $client = $response->json();
            return view('administration.customeredit', ['client' => $client]);
        }

        return redirect()->back()->withErrors('Impossible de récupérer les détails du client');
    }

}
