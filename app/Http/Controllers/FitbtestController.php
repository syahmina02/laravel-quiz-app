<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Fitbquestion;
use App\Models\FitbquestionCount;
use App\Models\Fitbresult;
use Illuminate\Http\Request;

class FitbtestController extends Controller
{
    public function index()
    {
        $fitbQuestionCounts = FitbquestionCount::pluck('count', 'category_id');

        $categories = Category::with([
            'categoryFitbQuestions' => function ($query) use ($fitbQuestionCounts) {
                $query->inRandomOrder();
            }
        ])->whereHas('categoryFitbQuestions')->get();

        foreach ($categories as $category) {
            $fitbQuestionCount = $fitbQuestionCounts[$category->id] ?? 0;
            $category->categoryFitbQuestions = $category->categoryFitbQuestions->take($fitbQuestionCount);
        }

        return view('client.fitbtest', compact('categories'));
    }

    public function store(Request $request)
    {
        $answers = $request->input('answers');
        $questions = Fitbquestion::whereIn('id', array_keys($answers))->get();
        $totalPoints = 0;

        $result = Fitbresult::create([
            'user_id' => auth()->id(),
            'total_points' => $totalPoints,
        ]);

        foreach ($questions as $question) {
            $userAnswer = $answers[$question->id];
            $correctAnswer = $question->answer;

            $points = ($userAnswer == $correctAnswer) ? 1 : 0;
            $totalPoints += $points;

            $result->fitbquestions()->attach($question->id, [
                'answer' => $userAnswer,
                'points' => $points,
            ]);
        }

        $result->update(['total_points' => $totalPoints]);

        return redirect()->route('client.fitbresults.show', $result->id)->with('result', $result);
    }
}