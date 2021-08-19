<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Log as FacadesLog;

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
        $product_model = Product::class;
        $operation = 'store';


        $validateData = $request->validate([
            'name' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->save();

       
        $product_id = $product->id;
        
        $log = new Log([
            'model_log_id' => $product_id,
            'model_log_type' => $product_model,
            'operation' => $operation,
        ]);
        
        $log->logs()->associate($product)->save();
        
        FacadesLog::channel('custom_products')->info([
            'model id' => $product->id,
            'model name' => $product_model,
            'action' => $operation,
            'created at: ' => date('d-m-Y',strtotime($product->created_at)),

        ]); 

       

        return redirect()->route('view.products');
    }

    public function EditProducts($id)
    {
        $product_model = Product::class;
        $operation = 'edit';

        $data['editData'] = Product::find($id);
        $product_id = $data['editData']->id;
        
        // $product_name = $data['editData']::where('id',$id)->first();

        
        $log = new Log([
            'model_log_id' => $product_id,
            'model_log_type' => $product_model,
            'operation' => $operation,
        ]);

        $log->logs()->associate($data['editData'])->save();

        FacadesLog::channel('custom_products')->info([
            'model id' => $product_id,
            'model name' => $product_model,
            'action' => $operation,
            
        ]);

        return view ('backend.products.edit_products', $data);
    }

    public function UpdateProducts(Request $request, $id)
    {
        $product_model = Product::class;
        $operation = 'update';

        $product = Product::find($id);
        $product->name = $request->name;
        $product->save();


        $product_id = $product->id;

        $log = new Log([
            'model_log_id' => $product_id,
            'model_log_type' => $product_model,
            'operation' => $operation,
        ]);

        $log->logs()->associate($product)->save();
        // $provider_name = $provider::where('id',$id)->first();
       

        FacadesLog::channel('custom_products')->info([
            'model id' => $product_id,
            'model name' => $product_model,
            'action' => $operation,
            'updated at: ' => date('d-m-Y',strtotime($product->udpated_at)),
        ]);

        return redirect()->route('view.products');
    }

    public function DeleteProducts($id)
    {
        $product_model = Product::class;
        $operation = 'destroy';

        $product = Product::find($id);
        $product->delete();

        $product_id = $product->id;
        
        $log = new Log([
            'model_log_id' => $product_id,
            'model_log_type' => $product_model,
            'operation' => $operation,
        ]);
        
        $log->logs()->associate($product)->save();
        

        FacadesLog::channel('custom_products')->info([
            'model id' => $product_id,
            'model name' => $product_model,
            'action' => $operation,
            'deleted at: ' =>  date('d-m-Y',strtotime($product->deleted_at)),
            
        ]); 

        return redirect()->route('view.products');

    }
}
