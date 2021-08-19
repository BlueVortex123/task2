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
        $provider_model = Provider::class;
        $operation = 'store';
        
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $provider = new Provider();
        $provider->name= $request->name;
        $provider->email= $request->email;
        
        $provider->save();
        
        $provider_id= $provider->id;
        
        $log = new Log([
            'model_log_id' => $provider_id,
            'model_log_type' => $provider_model,
            'operation' => $operation,
        ]);
        
        $log->logs()->associate($provider)->save();
        
        FacadesLog::channel('custom_providers')->info([

            'model id' => $provider->id,
            'model name' => $provider_model,
            'action' => $operation,
            'created at: ' => date('d-m-Y',strtotime($provider->created_at)),

        ]); 
       
        return redirect()->route('view.providers');   
        
        // $data['providers'] = Provider::with(['logs'])->first();
        // dd($data['providers']->toArray());
    }

    public function EditProvider($id)
    {
        $provider_model = Provider::class;
        $operation = 'edit';
        $data['editData'] = Provider::find($id);
        $provider_id = $data['editData']->id;

        
        $log = new Log([
            'model_log_id' => $provider_id,
            'model_log_type' => $provider_model,
            'operation' => $operation,
        ]);

        $log->logs()->associate($data['editData'])->save();
        // $provider_name = $provider::where('id',$id)->first();
       

        FacadesLog::channel('custom_providers')->info([
            'model id' => $provider_id,
            'model name' => $provider_model,
            'action' => $operation
        ]);
        
        //  dd($data['editData']->toArray());
        return view('backend.provider.edit_provider',$data);
    }

    public function UdpateProvider(Request $request,$id)
    {
        $provider_model = Provider::class;        
        $operation = 'update';
      
        $provider = Provider::find($id);
        $provider->name= $request->name;
        $provider->email= $request->email;
        $provider->save();

        $provider_id = $provider->id;

        $log = new Log([
            'model_log_id' => $provider_id,
            'model_log_type' => $provider_model,
            'operation' => $operation,
        ]);

        $log->logs()->associate($provider)->save();
        // $provider_name = $provider::where('id',$id)->first();
       

        FacadesLog::channel('custom_providers')->info([
            'model id' => $provider_id,
            'model name' => $provider_model,
            'action' => $operation,
            'updated at: ' =>  date('d-m-Y',strtotime($provider->deleted_at)),

        ]);

        return redirect()->route('view.providers');   
    }

    public function DeleteProvider($id)
    {
        $provider_model = Provider::class; 
        $operation = 'destroy';

        $provider = Provider::find($id);
        $provider->delete();
        
        $provider_id = $provider->id;
        
        $log = new Log([
            'model_log_id' => $provider_id,
            'model_log_type' => $provider_model,
            'operation' => $operation,
        ]);
        
        $log->logs()->associate($provider)->save();
        // $provider_name = $provider::where('id',$id)->first();
        

        FacadesLog::channel('custom_providers')->info([

            'model id' => $provider_id,
            'model name' => $provider_model,
            'action' => $operation,
            'deleted at: ' =>  date('d-m-Y',strtotime($provider->deleted_at)),

        ]);


        return redirect()->route('view.providers');   

    }
}
