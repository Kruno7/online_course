@extends('layouts.public.header')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Your score') }}</div>

                <div class="card-body">

                    @if ($totalResult < 50)
                        <h3>Beginner level</h3>
                    @elseif ($totalResult >= 50 && $totalResult <= 75)
                        <h3>Intermediate level</h3>
                    @elseif ($totalResult > 75)
                        <h3>Advanced level</h3>
                    @endif
                    
                    <form action="{{ route('user.quiz.store.result') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="numberCorrect" class="form-label">Number of Correct</label>
                                    <input type="text" class="form-control" id="numberCorrect" name="numberCorrect" disabled value="{{ $numberCorrect }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="numberInaccuracy" class="form-label">Number of Incorrect</label>
                                    <input type="text" class="form-control" id="numberInaccuracy" name="numberInaccuracy" disabled value="{{ $numberInaccuracy }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="totalResult" class="form-label">Total Result %</label>
                                    <input type="text" class="form-control" id="totalResult" name="totalResult" disabled value="{{ $totalResult }}">
                                </div>
                            </div>
                            <input type="hidden" name="quiz_id" value="{{ $quiz_id}}">
                        </div>
                        @guest
                            <p>If you want to save the result you have to register</p>
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Sign up for free</a>
                        @else
                            <button class="btn btn-primary">Save result</button>
                        @endguest
                    </form>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-6">
                    <h5 class="mt-2">Recommended course for you</h5>
                        @foreach ($courses as $course)
                            @if ($totalResult < 50 && $course->level === 'beginner')
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $course->name }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted"> {{ $course->level }}</h6>
                                        <p class="card-text">{{ $course->course_content }}.</p>
                                        @guest
                                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Sign up for free</a>
                                        @else
                                            <a href="{{ route('user.course.lessons', $course) }}" class="btn btn-block btn-outline-primary text-uppercase">Browse course</a>
                                        @endguest
                                    </div>
                                </div>
                            @elseif ($totalResult >= 50 && $totalResult <= 75 && $course->level === 'intermediate')
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $course->name }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted"> {{ $course->level }}</h6>
                                        <p class="card-text">{{ $course->course_content }}.</p>
                                        @guest
                                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Sign up for free</a>
                                        @else
                                            <a href="{{ route('user.course.lessons', $course) }}" class="btn btn-block btn-outline-primary text-uppercase">Browse course</a>
                                        @endguest
                                    </div>
                                </div>
                            @elseif ($totalResult > 75 && $course->level === 'advanced')
                                <h3>{{ $course->name }} {{ $course->level }}</h3>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $course->name }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted"> {{ $course->level }}</h6>
                                        <p class="card-text">{{ $course->course_content }}.</p>
                                        @guest
                                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Sign up for free</a>
                                        @else
                                            <a href="{{ route('user.course.lessons', $course) }}" class="btn btn-block btn-outline-primary text-uppercase">Browse course</a>
                                        @endguest
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
               
        </div>
    </div>

@endsection

