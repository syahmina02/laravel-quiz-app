<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TestController extends Controller
{
    public function index()
    {
        $categories = Category::with(['categoryQuestions' => function ($query) {
            $query->inRandomOrder()
                ->with(['questionOptions' => function ($query) {
                    $query->inRandomOrder();
                }]);
        }])->whereHas('categoryQuestions')->get();
    
        // Retrieve the updated question counts from the form input
        $questionCounts = session('question_counts');
    
        // Apply the updated question counts to the categories
        foreach ($categories as $category) {
            if (isset($questionCounts[$category->id])) {
                $category->categoryQuestions = $category->categoryQuestions->take($questionCounts[$category->id]);
            } else {
                $category->categoryQuestions = collect();
            }
        }
    
        return view('client.test', compact('categories'));
    }

    public function store(StoreTestRequest $request)
    {
        $questionCounts = $request->input('question_counts');

        // Loop through each category ID and corresponding question count
        foreach ($questionCounts as $categoryId => $questionCount) {
        // Retrieve the randomized questions for the current category
        $category = Category::with(['categoryQuestions' => function ($query) use ($questionCount) {
            $query->inRandomOrder()
                ->with(['questionOptions' => function ($query) {
                    $query->inRandomOrder();
                }])
                ->take($questionCount);
        }])->findOrFail($categoryId);

        // Process and store the randomized questions for the current category
        foreach ($category->categoryQuestions as $question) {
            $options = Option::find($request->input('questions.' . $question->id));

            $result = auth()->user()->userResults()->create([
                'total_points' => $options->sum('points')
            ]);

            // Store the options for the current question
            $result->questions()->attach($question->id, [
                'option_id' => $options->id,
                'points' => $options->points,
            ]);
        }
    }

        return redirect()->route('client.results.show', $result->id);
    }

}