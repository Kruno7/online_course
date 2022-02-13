@extends('layouts.public.header')

<style>
    .rating {
        display: flex;
    }

    .rating li {
        list-style-type: none;
    }

    .rating-item {
        border: 1px solid #fff;
        cursor: pointer;
        font-size: 3em;
        color: #F78009;
    }

    .rating-item::before {
        content: "\2605"
    }

    .rating-item.active ~ .rating-item::before {
        content: "\2606";
    }

    .rating:hover .rating-item::before {
        content: "\2605";
    }

    .rating-item:hover ~ .rating-item::before {
        content: "\2606";
    }

    #form {
        display: none;
    }
    
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                
                <div class="card-body">
                    <h5 class="card-title">{{ $course->name }} - {{ $course->level }}</h5>
                    <p class="card-text">{{ $course->course_content }}.</p>
                    <p><b>Number of members: </b>{{ $course->min_members }} - {{ $course->max_members }}</p>
                    <p><b>Type: </b>{{ $course->type_of_course }}</p>
                    <p><b>Start: </b>{{ $course->start_of_the_course }} <b>End: </b>{{ $course->end_of_the_course }}</p>
                    <hr>
                    <div>
                        <ul class="rating">
                            <li class="rating-item active" data-rate="1"></li>
                            <li class="rating-item" data-rate="2"></li>
                            <li class="rating-item" data-rate="3"></li>
                            <li class="rating-item" data-rate="4"></li>
                            <li class="rating-item" data-rate="5"></li>
                        </ul>
                        <form id="form">
                            <div class="mb-3">
                                <label for="comment" class="form-label">Comment</label>
                                <input type="text" class="form-control" id="comment" required>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" class="form-control" id="user" value="{{ Auth::user()->id }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                
                <ul class="list-group list-group-flush">
                    @foreach ($course->lessons as $lesson)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">{{ $lesson->name }}</div>
                        </div>
                        <span class="badge bg-primary rounded-pill">
                            <a href="{{ route('user.course.lesson.show', ['id'=>$course->id,'lesson_id'=>$lesson->id]) }}" style="color:white">Watch</a>
                        </span>
                    </li>
                  
                    @endforeach
                </ul>
            
            </div>
        </div>
        <div class="col-md-4">
            @foreach ($course->ratings as $rating)
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-12">
                        <div class="card-body">
                            <p class="card-title">{{ $rating->user->first_name }} {{ $rating->user->last_name }}</p>
                            <p class="card-text"><b>Rating: </b>{{ $rating->rating }}</p>
                            <p class="card-text"><b>Comment: </b>{{ $rating->comment }}</p>
                            @if ($rating->user->id === Auth::user()->id)
                            <form action="{{ route('user.rating.destroy', $rating->id) }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</button>
                            </form>
                            @endif
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <hr>
     
        </div>
    </div>
</div>

<script  type="application/javascript" src="{{ asset('js/main.js') }}"></script>


@endsection
