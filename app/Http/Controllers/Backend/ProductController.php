<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Log as ModelsLog;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function ViewProducts()
    {
        $data['products'] = Product::with(['contracts'])->get();
        //  ddd($data['products']->toArray());
        return view('backend.products.view_products',$data);
    }

    public function AddProducts()
    {
        return view('backend.products.add_products');
    }

    public function StoreProducts(Request $request)
    {
        $product_model = 'App\Models\Product';

        $validateData = $request->validate([
            'name' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->save();

        Log::info([
            'models_log_id' => $product->id,
            'models_log_type' => $product_model,
            'operation' => 'store'
        ]);
        
        $logs = new ModelsLog();
        $logs->operation = 'store';
        $logs->models_log_id = $product->id;
        $logs->models_log_type = $product_model;
        $logs->save();

        return redirect()->route('view.products');
    }

    public function EditProducts($id)
    {
        $product_model = 'App\Models\Product';
        $data['editData'] = Product::find($id);

        
        // $product_name = $data['editData']::where('id',$id)->first();

        Log::info([
            'models_log_id' => $data['editData']->id,
            'models_log_type' => $product_model,
            'operation' => 'edit'
        ]); 
        
        $logs = new ModelsLog();
        $logs->operation = 'edit';
        $logs->models_log_id = $data['editData']->id;
        $logs->models_log_type = $product_model;
        $logs->save();

        return view ('backend.products.edit_products', $data);
    }

    public function UpdateProducts(Request $request, $id)
    {
        $product_model = 'App\Models\Product';
        $product = Product::find($id);
        $product->name = $request->name;
        $product->save();

        Log::info([
            'models_log_id' => $product->id,
            'models_log_type' => $product_model,
            'operation' => 'update'
        ]);
        
        $logs = new ModelsLog();
        $logs->operation = 'update';
        $logs->models_log_id = $product->id;
        $logs->models_log_type = $product_model;
        $logs->save();

        return redirect()->route('view.products');
    }

    public function DeleteProducts($id)
    {
        $product_model = 'App\Models\Product';
        $product = Product::find($id);
        $product->delete();

        Log::info([
            'models_log_id' => $product->id,
            'models_log_type' => $product_model,
            'operation' => 'delete'
        ]);  
        
        // $product->storeLog();

        return redirect()->route('view.products');

    }

    public function storeLog(Request $request)
    {
        $product_model = 'App\Models\Product';
        $logs = new ModelsLog();
        $logs->operation = 'delete';
        $logs->models_log_id = $request->id;
        $logs->models_log_type = $product_model;
        $logs->save();
    }
}
