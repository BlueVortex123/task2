<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Log;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as FacadesLog;

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
        $provider->id= $request->id;
        $provider->name= $request->name;
        $provider->email= $request->email;
    
        $provider_model = 'App\Models\Provider';
        
        FacadesLog::info([
            'models_log_id' => $provider->id,
            'models_log_type' => $provider_model,
            'operation' => 'store',
        ]);
       
        $provider->save();
        return redirect()->route('view.providers');   
        
        // $data['providers'] = Provider::with(['logs'])->first();
        // dd($data['providers']->toArray());
    }

    public function EditProvider($id)
    {
        $data['editData'] = Provider::find($id);
        $provider = Provider::find($id);

        $provider_model = 'App\Models\Provider';

        // $provider_name = $provider::where('id',$id)->first();
        FacadesLog::info([
            'models_log_id' => $provider->id,
            'models_log_type' => $provider_model,
            'operation' => 'edit'
        ]);
        
        //  dd($data['editData']->toArray());
        return view('backend.provider.edit_provider',$data);
    }

    public function UdpateProvider(Request $request,$id)
    {
        $provider_model = 'App\Models\Provider';
        $provider = Provider::find($id);
        $provider->name= $request->name;
        $provider->email= $request->email;
        $provider->save();

        FacadesLog::info([
            'models_log_id' => $provider->id,
            'models_log_type' => $provider_model,
            'operation' => 'update'
        ]);

        return redirect()->route('view.providers');   
    }

    public function DeleteProvider($id)
    {
        $provider_model = 'App\Models\Provider';
        $provider = Provider::find($id);
        $provider->delete();

        $provider = Provider::find($id);
        FacadesLog::info([
            'models_log_id' => $provider->id,
            'models_log_type' => $provider_model,
            'operation' => 'delete'
        ]);

        return redirect()->route('view.providers');   

    }
}
