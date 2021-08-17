@extends('layout')

@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1>Products</h1>
                    <div class="float-right">
                        <a href="{{ route('add.products') }}" class="btn btn-success">Store new Product</a>
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
                                @foreach($products as $key => $product )
                                    @foreach($product->contracts as $contract)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $contract->name  }}</td>
                                   
                                    
                                    <td>
                                        <a href="{{ route('edit.products', $product->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ route('delete.products', $product->id ) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
            
@endsection()