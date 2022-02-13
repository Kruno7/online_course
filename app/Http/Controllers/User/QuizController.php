<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Course;

use Auth;

class QuizController extends Controller
{
    public function store (Request $request)
    {
        $data = $request->validate([
            'quizcheck' => 'required',
        ]);

        $quiz = Quiz::find($request->quiz_id);
        $totalQuestions = count($quiz->questions);

        $selected = $data['quizcheck'];
        $count = 0;
        $result = 0;

        foreach ($quiz->questions as $question) {
            $correct = 0;

            foreach ($question->answers as $answer) {
                
                if ($question->id == $answer->question_id && $answer->correct == 1) {
                    $correct++;
                    if ($answer->id == !empty($selected[$answer->id])) {
                        $numberQuestion = Answer::where('question_id', $answer->question_id)
                            ->where('correct', 1)->get();

                        $countQuestionInDB = $numberQuestion->count();

                        $result++;

                        if ($correct < $countQuestionInDB) {
                            $count++;
                        }
                    }
                }
            }
        }

        $numberCorrect = ($result - $count);
        $numberInaccuracy = ($totalQuestions - $numberCorrect);
        $totalResult = ($numberCorrect) / $totalQuestions * 100;

        return view('user.quiz.result')->with([
            'quiz_id'          => $request->quiz_id,
            'numberCorrect'    => $numberCorrect,
            'numberInaccuracy' => $numberInaccuracy,
            'totalResult'      => $totalResult,
            'courses'          => Course::where('language_id', $request->language_id)->get(),
        ]);
    }

    public function storeResult (Request $request)
    {
        DB::table('student_results')->insert([
            'user_id' => Auth::user()->id,
            'quiz_id' => $request->quiz_id,
            'correct' => $request->numberCorrect,
            'wrong'   => $request->numberInaccuracy,
            'total'   => $request->totalResult,
        ]);

        return redirect()->route('user.profile');
    }

    public function show($id)
    {
        return Quiz::find($id);
        return view('user.quiz.index')->with('quiz', Quiz::find($id));
    }

    public function getQuizByLanguageId ($language_id)
    {
        $quiz = Quiz::where('language_id', $language_id)->first();

        if (!empty($quiz)) {
            $quiz->load('questions.answers');
            return view('user.quiz.index')->with([
                'quiz' => $quiz,
            ]);
        } else {
            return redirect()->back();
        }
    }
}
