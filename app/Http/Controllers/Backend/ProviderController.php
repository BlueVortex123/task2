<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function ViewProvider()
    {
        $data['providers'] = Provider::all();
        return view('backend.provider.view_provider',$data);
    }
    
    public function AddProvider()
    {
        return view('backend.provider.add_provider');
    }

    public function StoreProvider(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $provider = new Provider();
        $provider->name= $request->name;
        $provider->email= $request->email;
        $provider->save();

        return redirect()->route('view.providers');    
    }

    public function EditProvider($id)
    {
        $data['editData'] = Provider::find($id);

        //  dd($data['editData']->toArray());
        return view('backend.provider.edit_provider',$data);
    }

    public function UdpateProvider(Request $request,$id)
    {
        $provider = Provider::find($id);
        $provider->name= $request->name;
        $provider->email= $request->email;
        $provider->save();

        return redirect()->route('view.providers');   
    }

    public function DeleteProvider($id)
    {
        $provider = Provider::find($id);
        $provider->delete();

        return redirect()->route('view.providers');   

    }
}
