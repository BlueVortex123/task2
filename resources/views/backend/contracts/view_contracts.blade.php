@extends('layout')

@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1>Contracts</h1>
                    <div class="float-right">
                        <a href="{{ route('add.contracts') }}" class="btn btn-success">Store new Contract</a>
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
                                @foreach($contracts as $key => $contract )
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $contract->name }}</td>
                                    <td>{{ $contract['provider']['name'] }}</td>
                                    <td>{{ date('d-m-Y', strtotime($contract->date)) }}</td>
                                    <th> - </th>
                                    <td>
                                        <a href="{{ route('edit.contracts', $contract->id ) }}" class="btn btn-info">Edit</a>
                                        <a href="" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
            
@endsection()