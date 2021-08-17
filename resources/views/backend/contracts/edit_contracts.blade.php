@extends('layout')

@section('content')

<div class="content-wrapper">
    <div class="container-full">
        <div class="row">
            <div class="col">
                    <div class="row">
                        <h3>Contracts Add Page</h3><br>
                    </div>
                <form method="post" action="{{ route('update.contracts', $editData->id) }}">
                    @csrf
                    <div class="row"> 
                        <div class="col-md-6">
                            <a href="{{ route('update.providers' , $editData->id) }}"  class="btn btn-rounded btn-success mb-5">View Providers</a>
                        </div>
                    </div>
                    <div class="row">  
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5> Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="name" value="{{ $editData->name }}"  class="form-control" required="" >
                                </div>
                            </div> 
                        </div> 
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>Provider Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="provider_id"  required="" class="form-control">
                                        <option value="" selected="" disabled="">Select Provider</option>
                                        @foreach($providers as $provider)
                                        <option value="{{ $provider->id }}" {{ ($editData->provider_id == $provider->id)? "selected" : ""  }} >{{ $provider->name }}</option>
                                        @endforeach
                                    </select>                                    
                                </div>
                            </div>  
                        </div>
                    </div>   
                   
                  
                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Date <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="date" value="{{ $editData->date }}"  class="form-control" required="" >
                                    </div>
                                </div> 
                            </div>
                        </div>
                    

                    <div class="text-xs-right">
                        <input type="submit" value="Submit" class="btn btn-rounded btn-info md-5">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection