@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Contracts</h1>
                    <div class="float-right">
                        <a href="{{ route('contracts.create') }}" class="btn btn-success">Store new Contract</a>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Provider</th>
                                    <th>Date</th>
                                    <th>Products</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contracts as $contract)
                                    <tr>
                                        <td>{{ $contract->id }}</td>
                                        <td>{{ $contract->name }}</td>
                                        <td>{{ $contract->provider->name }}</td>
                                        <td>{{ $contract->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            @foreach($contract->products as $product)
                                                <span>{{ $product->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('contracts.edit', $contract) }}" class="btn btn-primary float-left">Edit</a>
                                            <form action="{{ route('contracts.destroy', $contract) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger float-right">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('trashed_contracts') }}" class="btn btn-secondary float-right">Trash</a>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
@endsection