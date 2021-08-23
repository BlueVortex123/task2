@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <a href="{{ route('welcome') }}">Back</a>
            <div class="col-md-8">
                <h2 class="text-center">
                    @php
                        $model_name = explode('\\', optional($activities->first())->subject_type);
                        echo array_pop( $model_name );
                    @endphp 
                    Activities
                </h2>
                <ul>
                    <li>
                        <a href="{{ route('activity') }}">Back to All Activity</a>
                    </li>
                </ul>
                @forelse ($activities as $activity)
                    <div class="card mb-3">
                        <div class="card-header">
                            {{ $activity->created_at->toDayDateTimeString() }}<br>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Details</h5>
                            <ul>
                                <li>model: <strong>{{ $activity->subject_type }}</strong></li>
                                <li>id_model: <strong>{{ $activity->subject_id }}</strong></li>
                                <li>action: <strong>{{ $activity->name }}</strong></li>
                            </ul>
                        </div>
                    </div>
                @empty 
                    <div class="text-center">
                        <h2>No activity yet!</h2>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection