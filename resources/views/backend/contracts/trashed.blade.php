@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Temporary Deleted Contracts</h3>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Contracts</th>
                            <th scope="col">Deleted On</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contracts as $contract)
                            <tr>
                                <th scope="row">{{ $contract->id }}</th>
                                <td>{{ $contract->name }}</td>
                                <td>{{ $contract->deleted_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('restore_contracts', $contract) }}" class="btn btn-success">Restore</a>
                                </td>
                                <td>
                                    <a href="{{ route('permanently_delete_contracts', $contract) }}" class="btn btn-danger">Permanently Delete Contract</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <a href="{{ route('contracts.index') }}" class="btn btn-outline-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection