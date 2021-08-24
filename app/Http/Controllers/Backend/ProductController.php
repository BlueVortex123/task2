<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Log;
class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with('contracts')->get();
        //  dd($products->toArray());
        return view('backend.products.view_products',compact('products'));
    }

    public function create()
    {
        return view('backend.products.add_products');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
        ]);
        
        $product = new Product($validated);
        $product->name = $request->name;
        $product->save();
        
        
        return redirect()->route('products.index');
    }
    
    public function edit(Product $product)
    {
        // $products = Product::with('contracts')->get();
        
        return view ('backend.products.edit_products', compact('product'));
    }
    
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string',
        ]);
        
        $product->update($validated);
        $product->save();
     
    
        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');

    }

    public function onlyTrashedProducts()
    {
        $products = Product::onlyTrashed()->whereNotNull('deleted_at')->get();
        return view('backend.products.trashed', compact('products'));
    }

    public function restoreProducts(Request $request, $id)
    {
        Product::onlyTrashed()->find($id)->restore();
        return redirect()->route('trashed_products');
    }

    public function permanentlyDeleteProducts(Request $request, $id)
    {
        Product::onlyTrashed()->find($id)->forceDelete();
        return redirect()->route('trashed_products');
    }
}
