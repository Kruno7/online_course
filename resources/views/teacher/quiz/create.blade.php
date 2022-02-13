@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('Add Quiz') }}</div>

            <div class="card-body">
                <form action="{{ route('teacher.quiz.store') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="language_id">Quiz</label>
                            <select id="language_id" name="language_id" class="form-select @error('language_id') is-invalid @enderror">
                                <option selected="true" disabled="disabled">Choose...</option>
                                @foreach ($languages as $language)
                                    <option value="{{ $language->id }}">{{ $language->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12 mt-2">
                            <label for="inputQuizName">Quiz name</label>
                            <input type="text" name="quiz" class="form-control @error('quiz') is-invalid @enderror" id="inputQuizName" value="{{ old('quiz') }}">
                            @error('quiz')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-outline-primary btn-block mt-2">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
