<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Category;
use App\Models\QuestionCount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index()
    {
        $questionCounts = QuestionCount::pluck('count', 'category_id');

        $categories = Category::with(['categoryQuestions' => function ($query) {
        $query->inRandomOrder()
            ->with(['questionOptions' => function ($query) {
                $query->inRandomOrder();
            }]);
        }])->whereHas('categoryQuestions')->get();

        foreach ($categories as $category) {
            $questionCount = $questionCounts[$category->id] ?? 0;
            $category->categoryQuestions = $category->categoryQuestions->take($questionCount);
    }

        return view('client.test', compact('categories'));
    }

    public function store(StoreTestRequest $request)
    {
        $questionCounts = session('question_counts', []);

        foreach ($questionCounts as $categoryId => $questionCount) {
        $category = Category::findOrFail($categoryId);

        $questions = $category->categoryQuestions()
            ->inRandomOrder()
            ->limit($questionCount)
            ->get();

        foreach ($questions as $question) {
            // Store the selected options for the question
            $options = Option::find($request->input("questions.{$question->id}"));
            // Store the result and its associated options
            $result = auth()->user()->userResults()->create([
                'total_points' => $options->sum('points'),
            ]);
            $result->questions()->attach($question->id, [
                'option_id' => $options->id,
                'points' => $options->points,
            ]);
         }
    }

    return redirect()->route('client.results.show', $result->id);
}


}