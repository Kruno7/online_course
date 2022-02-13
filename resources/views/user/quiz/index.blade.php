@extends('layouts.public.header')

@section('scripts')
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

@endsection
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6" >
            
                <div class="card"  style="background-color: #567; color: #ddd;">
                    <div class="card-header">{{ $quiz->name }} </div>
                    <div class="card-body">
                        <div id="page-wrap">
                        
                            <form action="{{ route('user.quiz.store') }}" method="post" id="quiz">
                                @csrf

                                @foreach($quiz->questions as $key => $question)
                                    <ul style="list-style-type: none">
                                        <li>
                                            <h3>{{ $key+1 }}. {{ $question->question }}...</h3>
                                            @error('quizcheck')
                                            <small class="form-text text-warning">{{ $message }}</small>
                                            @enderror
                                            @foreach($question->answers as $answer)
                                                <div>
                                                    <input type="checkbox" name="quizcheck[{{ $answer->id }}]" id="question-1-answers-A" value="{{ $answer->question_id }}" />
                                                    <label for="question-1-answers-A"> {{ $answer->answer }} </label>
                                                </div>
                                            @endforeach
                                            <hr>
                                        </li>
                                    </ul>
                                @endforeach
                                <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                                <input type="hidden" name="language_id" value="{{ $quiz->language_id }}">
                                <input type="submit" name="submit" value="Submit" class="btn btn-outline-primary text-white">
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>

@endsection


