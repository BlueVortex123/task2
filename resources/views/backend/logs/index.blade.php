@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (count($lastActivity))
                    <h2 class="text-center">All Activity</h2>
                    <ul>
                        <li>
                            <a href="{{ route('list_activity', ['contract']) }}">See All Activities related to Contract Model</a>
                        </li>
                        <li>
                            <a href="{{ route('list_activity', ['product']) }}">See All Activities related to Product Model</a>
                        </li>
                        <li>
                            <a href="{{ route('list_activity', ['provider']) }}">See All Activities related to Provider Model</a>
                        </li>
                    </ul>
                    @foreach ($lastActivity as $log)
                        <div class="card mb-3">
                            <div class="card-header">
                                {{ $log->created_at->toDayDateTimeString() }}<br>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Details</h5>
                                <ul>
                                    <li>model: <strong>{{ $log->subject_type }}</strong></li>
                                    <li>id_model: <strong>{{ $log->subject_id }}</strong></li>
                                    <li>action: <strong>{{ $log->name }}</strong></li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                @else 
                    <div class="text-center">
                        <h2>No activity yet!</h2>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection