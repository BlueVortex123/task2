@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3>Contracts Edit Page</h3><br>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action="{{ route('contracts.update', $contract) }}">
                @csrf
                @method('PUT')
    
                <div class="form-group"> 
                    <a href="{{ route('contracts.index') }}"  class="btn btn-rounded btn-primary mb-5">Back</a>
                </div>
                
                <div class="form-group">  
                    <h5> Name <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="name" value="{{ $contract->name }}"  class="form-control" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <h5>Provider Name <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <select name="provider_id" required class="form-control">
                            <option value="" selected="" disabled="">Select Provider</option>
                            @foreach($providers as $provider)
                                <option value="{{ $provider->id }}" {{ ($contract->provider_id == $provider->id)? "selected" : ""  }} >{{ $provider->name }}</option>
                            @endforeach
                        </select>                                    
                    </div>
                </div>  
                
                <div class="form-group">
                    <label for='products'>
                        <h5>
                            Products
                            <span class="text-danger">*</span>
                        </h5>
                    </label>
                    <select id="products" class="custom-select @error('products') is-invalid @enderror" autocomplete="products" autofocus name="products[]" multiple>
                        @foreach ($products as $prod)
                            <option value="{{$prod->id}}" {{ in_array($prod->id,$selected_products)?'selected':''}}> {{$prod->name}}</option>
                        @endforeach
                    </select>
                </div>
              
                <div class="form-group">
                    <h5>Date<span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="date" name="date" value="{{ $contract->date }}"  class="form-control" required>
                    </div>
                </div> 
    
                <div class="form-group">
                    <input type="submit" value="Submit" class="btn btn-rounded btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection