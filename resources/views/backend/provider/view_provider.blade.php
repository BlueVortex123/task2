@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Providers</h1>
                    <div class="float-right">
                        <a href="{{ route('providers.create') }}" class="btn btn-success">Store new Provider</a>
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
                                        <a href="{{ route('providers.edit' , $provider->id) }}" class="btn btn-primary float-left">Edit</a>
                                        <form action="{{ route('providers.destroy', $provider) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger float-right">Delete</button>
                                        </form>                                    
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('trashed_providers') }}" class="btn btn-secondary float-right">Trash</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection()