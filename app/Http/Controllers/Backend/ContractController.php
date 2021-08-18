<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractProduct;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


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

        
        Log::info([
            'models_log_id' => $products->id,
            'models_log_type' => $contract_model,
            'operation' => 'store'
        ]);       

        return redirect()->route('view.contracts');
    }

    public function EditContracts($id)
    {
        $contract_model = 'App\Models\Contract';
        $data['editData'] = Contract::with(['provider'])->with(['products'])->where('id',$id)->first();
        $data['products'] = Product::all();
        $data['providers'] = Provider::all();


        $contracts = Contract::find($id);
        // $contract_name = $contracts::where('id',$id)->first();
        Log::info([
            'models_log_id' => $contracts->id,
            'models_log_type' => $contract_model,
            'operation' => 'edit'
        ]);       
        
        // $data['selectedProducts'] = $data['editData']->products()->pluck('name')->toArray();

        return view('backend.contracts.edit_contracts', $data);
        
    }

    public function UpdateContracts(Request $request, $id)
    {
        $contract_model = 'App\Models\Contract';
        $products = Product::all();
        $products->product_id = $request->product_id;
       
        $contract = Contract::find($id);
        $contract->provider_id = $request->provider_id;
        $contract->name = $request->name;
        $contract->date = $request->date;
        $contract->save();

 
        // $contract->products()->attach($request->product_id);
        // $contract->products()->dettach($request->product_id);
        // $contract_name = $contract::where('id',$id)->first();


        Log::info([
            'models_log_id' => $contract->id,
            'models_log_type' => $contract_model,
            'operation' => 'update'
        ]);       

        return redirect()->route('view.contracts');
        
    }
    
    public function DeleteContracts($id)
    {
        $contract_model = 'App\Models\Contract';
        $contract = Contract::find($id);
        $contract->delete();

        Log::info([
            'models_log_id' => $contract->id,
            'models_log_type' => $contract_model,
            'operation' => 'delete'
        ]);       
        
        return redirect()->route('view.contracts');
    }
}
