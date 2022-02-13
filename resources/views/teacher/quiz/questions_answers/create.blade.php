@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Add Questions and Answers to the Quiz') }}</div>
                <div class="card-body">
                    <form action="{{ route('teacher.quiz.qa-store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputQuiz">Quiz</label>
                                <select id="inputQuiz" name="quiz" class="form-control">
                                    <option selected="true" disabled="disabled">Choose...</option>
                                     @foreach($quizzes as $quiz) 
                                        <option value="{{ $quiz->id }}">{{  $quiz->name  }}</option>
                                     @endforeach 
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputQuestion">Question</label>
                                <input type="text" name="question[question]" class="form-control" id="inputQuestion">
                                @error('question.question')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                          <div class="row">
                            <div class="form-group mb-3 col-md-6">
                                <label for="inputAnswer1">1. Answer</label>
                                <input type="text" name="answers[][answer]" class="form-control" id="inputAnswer1">
                                <input type="hidden" id="correctAnswer1" name="correct1" value="{{ 0 }}" />
                                <input type="checkbox" id="correctAnswer1" name="correct1" value="{{ 1 }}">
                                <label for="correctAnswer1"> Mark as the correct answer</label><br>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAnswer2">2. Answer</label>
                                <input type="text" name="answers[][answer]" class="form-control" id="inputAnswer2">

                                <!--<input type="hidden" id="correctAnswer2" name="correct[][correct]" value="{{ 0 }}" />-->
                                <input type="hidden" id="correctAnswer2" name="correct2" value="{{ 0 }}" />
                                <input type="checkbox" id="correctAnswer2" name="correct2" value="{{ 1 }}">

                                <label for="correctAnswer2"> Mark as the correct answer</label><br>
                            </div>
                          </div>
                            
                            <div class="row mb-3">
                                <div class="form-group col-md-6">
                                    <label for="inputAnswer3">3. Answer</label>
                                    <input type="text" name="answers[][answer]"  class="form-control" id="inputAnswer3">
                                    <input type="hidden" id="correctAnswer3" name="correct3" value="{{ 0 }}" />
                                    <input type="checkbox" id="correctAnswer3" name="correct3" value="{{ 1 }}">
                                    <label for="correctAnswer3"> Mark as the correct answer</label><br>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputAnswer4">4. Answer</label>
                                    <input type="text" name="answers[][answer]"  class="form-control" id="inputAnswer4">
                                    <input type="hidden" id="correctAnswer4" name="correct4" value="{{ 0 }}" />
                                    <input type="checkbox" id="correctAnswer4" name="correct4" value="{{ 1 }}">
                                    <label for="correctAnswer4"> Mark as the correct answer</label><br>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-outline-primary btn-block">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection
