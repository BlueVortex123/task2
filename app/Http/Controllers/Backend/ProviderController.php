<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{

    public function index()
    {
    
        $providers = Provider::all();
        return view('backend.provider.view_provider',compact('providers'));
    }
    
    public function create()
    {
        
        return view('backend.provider.add_provider');

    }

    public function store(Request $request)
    {
        // $provider_model = Provider::class;
        // $operation = 'store';
        
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email',
        ]);
        
        $provider = new Provider($validated);
        $provider->name= $request->name;
        $provider->email= $request->email;
        $provider->save();
        
        return redirect()->route('providers.index');   
        
        // $data['providers'] = Provider::with(['logs'])->first();
        // dd($data['providers']->toArray());
    }
    
    public function edit(Provider $provider)
    {
        return view('backend.provider.edit_provider',compact('provider'));
    }
    
    public function update(Request $request,Provider $provider)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email',
        ]);
        
        $provider->update($validated);
        $provider->save();

        return redirect()->route('providers.index');   
    }

    public function destroy(Provider $provider)
    {
        $provider->delete();
        return redirect()->route('providers.index');   
    }

    public function onlyTrashedProviders()
    {
        $providers = Provider::onlyTrashed()->whereNotNull('deleted_at')->get();
        return view('backend.provider.trashed', compact('providers'));
    }

    public function restoreProviders(Request $request, $id)
    {
        Provider::onlyTrashed()->find($id)->restore();
        return redirect()->route('trashed_providers');
    }

    public function permanentlyDeleteProviders(Request $request, $id)
    {
        Provider::onlyTrashed()->find($id)->forceDelete();
        return redirect()->route('trashed_providers');
    }
}
