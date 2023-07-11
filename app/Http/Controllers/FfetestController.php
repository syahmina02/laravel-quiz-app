<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FfequestionCount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FfetestController extends Controller
{
    public function index()
    {
        $ffeQuestionCounts = FfequestionCount::pluck('count', 'category_id');

        $categories = Category::with([
            'categoryFfeQuestions' => function ($query) use (ffeQuestionCounts){
            $query->inRandomOrder()
                ->with(['ffequestionOptions' => function ($query) {
                    $query->inRandomOrder();
                }]);
        }])->whereHas('categoryFfeQuestions')->get();

        foreach ($categories as $category) {
            $ffeQuestionCount = $ffeQuestionCounts[$category->id] ?? 0;
            $category->categoryFfeQuestions = $category->categoryFfeQuestions->take($ffeQuestionCount);
        }

        return view('client.ffetest', compact('categories'));
    }

    public function store(StoreFfeTestRequest $request)
    {
        $options = Option::find(array_values($request->input('questions')));

        $result = auth()->user()->userResults()->create([
            'total_points' => $options->sum('points')
        ]);

        $questions = $options->mapWithKeys(function ($option) {
            return [$option->question_id => [
                'option_id' => $option->id,
                'points' => $option->points
            ]];
        })->toArray();

        $result->questions()->sync($questions);

        return redirect()->route('client.results.show', $result->id);
    }
}