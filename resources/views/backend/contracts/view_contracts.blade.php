@extends('layout')

@section('content')
<div class="content-wrapper">
    <div class="container-full">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right"><h4>Task 2</h4></div>
            </div>
            <div class="pull-right">
                <a href="{{ route('add.contracts') }}" class="btn btn-success">Store new Contract</a>
            </div>
        </div>

        <div class="row">
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
                        <td>{{ $cotnract['provider']['name'] }}</td>
                        <td>{{ date('d-m-Y', strtotime($contract->date)) }}</td>
                        <td></td>
                        <td>
                            <a href="#" class="btn btn-info">Edit</a>
                            <a href="#" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

        
@endsection()