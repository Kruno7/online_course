@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Lesson') }}</div>

                <div class="card-body">
                    <form action="{{ route('teacher.lessons.update', $lesson) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <label for="course_id">Example select</label>
                        <select class="form-select @error('course') is-invalid @enderror" id="course_id" name="course_id">
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}" {{ $course->id == $lesson->course_id ? 'selected' : '' }}>{{ $course->name }}</option>                                     
                            @endforeach
                        </select>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $lesson->name }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">File</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file">
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
