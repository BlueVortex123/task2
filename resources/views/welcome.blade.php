@extends('layouts.app')

@section('content')
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="row text-center">
                <div class="col">
                    <a href="{{ route('activity') }}" class="btn btn-outline-primary btn-lg btn-block"><strong>Activity</strong></a>
                </div>
            </div>
        </div>
    </div>
@endsection