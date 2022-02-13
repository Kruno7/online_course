@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @include('partials.alert')
                <div class="card-header">{{ __('Lessons') }}</div>

                <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Level</th>
                            <th scope="col">Show</th>
                            <th scope="col">Add</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                        <tr>
                            <th scope="row">{{ $course->id }}</th>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->level }}</td>
                            <td>
                                <a href="{{ route('teacher.lessons.show', $course->id) }}" class="btn btn-outline-primary btn-sm">Show</a>
                            </td>
                            <td>
                                <a href="{{ route('teacher.lessons.create') }}" class="btn btn-outline-primary btn-sm">Add</a>
                            </td>
                        </tr>  
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
