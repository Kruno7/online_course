@extends('layouts.public.header')

@section('content')

    <div class="container">
    @include('partials.alert')
        <section>
            <div class="jumbotron">      
                <p class="text-center" style="color: #4A5A80">COURSES</p>
                <h1 class="text-center" style="color: #4A5A80">Newest Courses</h1>
                <hr>
            </div>
        </section>


        <section class="pricing py-5">
            <div class="container">
                <div class="row">
                    
                    @foreach ($courses as $course)
                    <div class="col-lg-4">
                        <div class="card mb-5 text-center">
                            <div class="card-header" style="background-color: #4A5A80">
                                <h4 class="my-0 font-weight-normal text-light">Free</h4>
                            </div>
                            <div class="card-body" style="border: 1px solid #4A5A80">
                                <img src="{{ asset('storage/'. $course->img) }}" class="card-img-top" alt="...">
                                <h1 class="card-title pricing-card-title">$0 <small class="text-muted">/ mo</small></h1>
                                <h5 class="card-title text-muted text-uppercase">{{ $course->name }}</h5>
                                <h6 class="text-center">{{ $course->level }}</h6>
                                <hr>
                                <ul class="list-group">
                                    @foreach ($course->lessons as $c)
                                        <li class="list-group-item d-flex justify-content-between align-items-start mb-1">{{ $c->name }}</li>
                                        @endforeach
                                    
                                   </ul>
                                @guest
                                    <a href="{{ route('login') }}" class="btn btn-lg btn-block btn-outline-primary btn-block">Sign up for free</a>
                                @else
                                    <a href="{{ route('user.course.lessons', $course) }}" class="btn btn-block btn-outline-primary text-uppercase">Browse course</a>
                                @endguest
                               
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </section>
    </div>

@endsection

