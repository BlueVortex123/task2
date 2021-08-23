<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Log as FacadesLog;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::with(['products', 'provider'])->get();
        return view('backend.contracts.view_contracts', compact('contracts'));

    }

    public function create()
    {
        $providers = Provider::with('contracts')->get();
        $products = Product::with('contracts')->get();
        return view('backend.contracts.add_contracts', compact('providers', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'date' => 'required',
        ]);
       
        $contract = new Contract($validated);
        $contract->provider_id = $request->provider_id;
        $contract->save();
        
        $contract->products()->sync(request('products'));

        return redirect()->route('contracts.index');
    }

    public function edit(Contract $contract)
    {
        $providers = Provider::with('contracts')->get();
        $products = Product::with('contracts')->get();
        $selected_products = [];
        foreach ($contract->products as $sel_prod)
        {
            array_push($selected_products, $sel_prod->id);
        }

        return view('backend.contracts.edit_contracts', compact('contract', 'providers', 'products', 'selected_products'));
        
    }

    public function update(Request $request, Contract $contract)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'date' => 'required',
        ]);
       
        $contract->update($validated);
        $contract->provider_id = $request->provider_id;
        $contract->save();
        
        $contract->products()->sync(request('products'));

        return redirect()->route('contracts.index');
        
    }
    
    public function destroy(Contract $contract)
    {
        $contract->delete();
        return redirect()->route('contracts.index');
    }
    
    public function onlyTrashedContracts()
    {
        $contracts = Contract::onlyTrashed()->whereNotNull('deleted_at')->get();
        return view('backend.contracts.trashed', compact('contracts'));
    }

    public function restoreContracts(Request $request, $id)
    {
        Contract::onlyTrashed()->find($id)->restore();
        return redirect()->route('trashed_contracts');
    }

    public function permanentlyDeleteContracts(Request $request, $id)
    {
        Contract::onlyTrashed()->find($id)->forceDelete();
        return redirect()->route('trashed_contracts');
    }

}
