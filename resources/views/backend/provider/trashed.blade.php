@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Temporary Deleted providers</h3>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Providers</th>
                            <th scope="col">Deleted On</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($providers as $provider)
                            <tr>
                                <th scope="row">{{ $provider->id }}</th>
                                <td>{{ $provider->name }}</td>
                                <td>{{ $provider->deleted_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('restore_providers', $provider) }}" class="btn btn-success">Restore</a>
                                </td>
                                <td>
                                    <a href="{{ route('permanently_delete_providers', $provider) }}" class="btn btn-danger">Permanently Delete provider</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <a href="{{ route('providers.index') }}" class="btn btn-outline-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection