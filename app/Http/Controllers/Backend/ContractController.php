<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function ViewContracts()
    {
        $data['providers'] = Provider::all();
        $data['contracts'] = Contract::with(['products'])->get();

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
        $validateData = $request->validate([
            'name' => 'required',
            'date' => 'required',
        ]);

        $contract = new Contract();
        $contract->provider_id = $request->provider_id;
        $contract->name = $request->name;
        $contract->date = $request->date;
        $contract->save();

        return redirect()->route('view.contracts');
    }

    public function EditContracts($id)
    {
        $data['editData'] = Contract::with(['provider'])->where('id',$id)->first();
        $data['providers'] = Provider::all();
        // dd($data['editData']->toArray());
        return view('backend.contracts.edit_contracts', $data);
    }

    public function UpdateContracts(Request $request, $id)
    {
        $contract = Contract::find($id);
        $contract->provider_id = $request->provider_id;
        $contract->name = $request->name;
        $contract->date = $request->date;
        $contract->save();

        return redirect()->route('view.contracts');
        
    }
    
    public function DeleteContracts($id)
    {
        $contract = Contract::find($id);
        $contract->delete();
        
        return redirect()->route('view.contracts');
    }
}
