<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractProduct;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Log as FacadesLog;

class ContractController extends Controller
{
    public function ViewContracts()
    {
        $data['providers'] = Provider::all();
        $data['contracts'] = Contract::with(['products'])->with(['logs'])->get();
        
        return view('backend.contracts.view_contracts',$data);

    }

    public function AddContracts()
    {
        $data['providers'] = Provider::all();
        $data['products'] = Product::all();
        return view('backend.contracts.add_contracts',$data);

    }

    public function StoreContracts(Request $request)
    {
        $contract_model = 'App\Models\Contract';
        $operation = 'store';

      
        $validateData = $request->validate([
            'name' => 'required',
            'date' => 'required',
        ]);

        $products = Product::all();
        $products->product_id = $request->product_id;
       
        $contract = new Contract();
        $contract->provider_id = $request->provider_id;
        $contract->name = $request->name;
        $contract->date = $request->date;
        $contract->save();
        
        $contract->products()->attach($request->product_id);

        $contract_id= $contract->id;
        
        $log = new Log([
            'model_log_id' => $contract_id,
            'model_log_type' => $contract_model,
            'operation' => $operation,
        ]);
        
        $log->logs()->sync($contract)->save();
        
        FacadesLog::channel('custom_contracts')->info([
            'model id' => $contract->id,
            'model name' => $contract_model,
            'action' => $operation,
            'created at: ' => date('d-m-Y',strtotime($contract->created_at)),

        ]); 

        return redirect()->route('view.contracts');
    }

    public function EditContracts($id)
    {
        $contract_model = Contract::class;
        $operation = 'edit';
        
        
        $data['editData'] = Contract::with(['provider'])->with(['products'])->where('id',$id)->first();
        $data['products'] = Product::all();
        $data['providers'] = Provider::all();
       

        $contract_id= $data['editData']->id;
        
        $log = new Log([
            'model_log_id' => $contract_id,
            'model_log_type' => $contract_model,
            'operation' => $operation,
        ]);
        
        $log->logs()->associate($data['editData'])->save();
        
        FacadesLog::channel('custom_contracts')->info([
            'model id' => $data['editData']->id,
            'model name' => $contract_model,
            'action' => $operation,
        ]); 
        
        // $data['selectedProducts'] = $data['editData']->products()->pluck('name')->toArray();

        return view('backend.contracts.edit_contracts', $data);
        
    }

    public function UpdateContracts(Request $request, $id)
    {
        $contract_model = Contract::class;
        $operation = 'update';
        
        $products = Product::all();
        $products->product_id = $request->product_id;
        
        $contract = Contract::find($id);
        $contract_id = $contract->id;
        $contract->provider_id = $request->provider_id;
        $contract->name = $request->name;
        $contract->date = $request->date;
        $contract->save();
        
        $contract->products()->sync($request->product_id);

 
        $contract_id = $contract->id;

        $log = new Log([
            'model_log_id' => $contract_id,
            'model_log_type' => $contract_model,
            'operation' => $operation,
        ]);

        $log->logs()->associate($contract)->save();
        // $provider_name = $provider::where('id',$id)->first();
       

        FacadesLog::channel('custom_contracts')->info([
            'model id' => $contract_id,
            'model name' => $contract_model,
            'action' => $operation,
            'updated at: ' =>  date('d-m-Y',strtotime($contract->updated_at)),

        ]);
        
     
        return redirect()->route('view.contracts');
     
     
        // $contract->products()->attach($request->product_id);
        // $contract->products()->dettach($request->product_id);
        // $contract_name = $contract::where('id',$id)->first();
        
    }
    
    public function DeleteContracts($id)
    {
        $contract_model = Contract::class;
        $operation = 'destroy';

        $contract = Contract::find($id);
        $contract->delete();


        $contract_id = $contract->id;
        
        $log = new Log([
            'model_log_id' => $contract_id,
            'model_log_type' => $contract_model,
            'operation' => $operation,
        ]);
        
        $log->logs()->associate($contract)->save();
        // $provider_name = $provider::where('id',$id)->first();
        

        FacadesLog::channel('custom_contracts')->info([
            'model id' => $contract_id,
            'model name' => $contract_model,
            'action' => $operation,
            'deleted at: ' =>  date('d-m-Y',strtotime($contract->deleted_at)),

        ]);
        
        return redirect()->route('view.contracts');
    }

   

}
