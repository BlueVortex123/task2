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
        $data['products'] = Product::with(['contracts'])->get();
        // dd($data['products']->toArray());
        return view('backend.products.view_products',$data);
    }

    public function AddProducts()
    {
        return view('backend.products.add_products');
    }

    public function StoreProducts(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->save();

        return redirect()->route('view.products');
    }

    public function EditProducts($id)
    {
        $data['editData'] = Product::find($id);
        return view ('backend.products.edit_products', $data);
    }

    public function UpdateProducts(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->save();

        return redirect()->route('view.products');
    }
}
