@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Show Lessons') }}</div>

                <div class="card-body">
                    @foreach ($course->lessons as $lesson)
                    <div class="card mb-3">
                        <iframe src="{{ asset('storage/' . $lesson->file) }}" width="100%" height="400">Your browser isn't compatible</iframe>
                    
                        <div class="card-body">
                            <h5 class="card-title">{{ $lesson->name }}</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-muted">Last updated 3 hours ago</small></p>
                            <div class="row">
                                <div class="col-md-1">
                                <a href="{{ route('teacher.lessons.edit', $lesson) }}" class="btn btn-outline-warning">Edit</a>
                                </div>
                                <div class="col-md-11">
                                <form action="{{ route('teacher.lessons.destroy', $lesson) }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?');">Delete</button>
                                </form>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
    
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
