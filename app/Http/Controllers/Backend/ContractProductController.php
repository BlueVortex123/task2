<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Http\Request;

class ContractProductController extends Controller
{
    public function AddContractProduct()
    {
        $data['contracts'] = Contract::all();
        $data['products'] = Product::all();


        return view('backend.add_contract_product', $data);
    }

    public function StoreContractProduct(Request $request)
    {
    
      
       
     
    }

    public function EditContractProduct($id)
    {
        
    }

    public function UpdateContractProduct(Request $request, $id)
    {
        # code...
    }
}