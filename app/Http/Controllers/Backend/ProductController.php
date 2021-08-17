<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function ViewProducts()
    {
        $data['contracts'] = Contract::all();
        $data['products'] = Product::all();
        return view('backend.products.view_products',$data);
    }

    public function AddProducts()
    {
        $data['contracts'] = Contract::all();
        return view('backend.products.add_products',$data);
    }
}
