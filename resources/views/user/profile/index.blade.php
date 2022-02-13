@extends('layouts.public.header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    <h3>Your courses</h3>
                    @foreach ($user->quizzes as $quiz)
                        {{ $quiz->name }}
                    @endforeach
                    <hr>
                    <h4>Your score</h4>
                    @foreach ($results as $result)
                        <p><b>Corect: </b>{{ $result->correct }}</p>
                        <p><b>Wrong: </b>{{ $result->wrong }}</p>
                        <p><b>Total: </b>{{ $result->total }}%</p>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
