@extends('layouts.app')

@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1>Providers</h1>
                    <div class="float-right">
                        <a href="{{ route('add.providers') }}" class="btn btn-success">Store new Provider</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                                <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($providers as $key => $provider )
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $provider->name }}</td>
                                    <td>{{ $provider->email }}</td>
                                    <td>
                                        <a href="{{ route('edit.providers' , $provider->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ route('delete.providers' , $provider->id) }}" class="btn btn-danger">Delete</a>
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