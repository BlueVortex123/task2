@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center mb-4">
        <h3>Provider Add Page</h3><br>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action="{{ route('providers.store') }}">
                @csrf

                <div class="form-group">
                    <a href="{{ route('providers.index') }}" class="btn btn-rounded btn-primary mb-5">Back</a>
                </div>

                <div class="form-group">
                    <h5> Name <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="name" class="form-control" required="">
                    </div>
                </div>



                <div class="form-group">
                    <h5>Email <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="email" name="email" class="form-control" required="">
                    </div>
                </div>

                <div class="text-xs-right">
                    <input type="submit" value="Submit" class="btn btn-rounded btn-info md-5">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection