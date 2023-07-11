<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Fitbquestion;
use App\Models\FitbquestionCount;
use App\Models\Question;
use App\Models\QuestionCount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;

class FitbtestAdminController extends Controller
{
    public function edit()
    {
        $categories = Category::all();
        $fitbquestionCounts = [];

        // Retrieve the current question counts for each category
        foreach ($categories as $category) {
            $fitbquestionCount = FitbquestionCount::where('category_id', $category->id)->first();
            $fitbquestionCounts[$category->id] = $fitbquestionCount ? $fitbquestionCount->count : 0;
        }

        return view('admin.fitbquestion_count.edit', compact('categories', 'fitbquestionCounts'));
    }

    public function update(Request $request)
    {
        $fitbquestionCounts = $request->input('fitbquestion_counts');

        // Save the question counts in the database
        foreach ($fitbquestionCounts as $categoryId => $count) {
            FitbquestionCount::updateOrCreate(['category_id' => $categoryId], ['count' => $count]);
        }

        return redirect()->route('admin.dashboard.index')->withSuccess('Question counts updated successfully.');
    }

}