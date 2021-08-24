@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Products</h1>
                    <div class="float-right">
                        <a href="{{ route('products.create') }}" class="btn btn-success">Store new Product</a>
                    </div>
                </div>
               
                <div class="card-body">
                    <div class="table-responsive">
                                <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Contract</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product )
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <th>
                                        @foreach($product->contracts as $contract)
                                        <span>{{ $contract->name }}</span>
                                        @endforeach
                                    </th>
                                    
                                    <td>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info float-left">Edit</a>
                                        <form action="{{ route('products.destroy', $product) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger float-right">Delete</button>
                                            </form>                                    
                                        </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('trashed_products') }}" class="btn btn-secondary float-right">Trash</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            
@endsection()