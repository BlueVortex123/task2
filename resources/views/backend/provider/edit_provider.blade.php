@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h3>Provider Add Page</h3><br>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form method="post" action="{{ route('providers.update' , $provider) }} ">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <a href="{{ route('providers.index') }}" class="btn btn-rounded btn-primary mb-5">View Providers</a>
                </div>


                <div class="form-group">
                    <h5> Name <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="name" value="{{ $provider->name }}" class="form-control" required="">
                    </div>
                </div>




                <div class="form-group">
                    <h5>Email <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="email" name="email" value="{{ $provider->email }}" class="form-control" required="">
                    </div>
                </div>


        <div class="text-xs-right">
            <input type="submit" value="Update " class="btn btn-rounded btn-success ">
        </div>
        </form>
    </div>
</div>
</div>
</div>

@endsection