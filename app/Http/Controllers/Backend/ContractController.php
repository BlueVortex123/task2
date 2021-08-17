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
        $data['contracts'] = Contract::all();

        return view('backend.contracts.view_contracts',$data);

    }

    public function AddContracts()
    {
        $data['providers'] = Provider::all();
        $data['products'] = Product::all();
        return view('backend.contracts.add_contracts',$data);

    }
}
