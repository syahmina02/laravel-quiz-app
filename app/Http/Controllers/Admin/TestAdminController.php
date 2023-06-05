<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;

class TestAdminController extends Controller
{
    public function edit()
    {
        $categories = Category::all();
        $questionCounts = [];

        // Retrieve the current question counts for each category
        foreach ($categories as $category) {
        $questionCounts[$category->id] = Question::where('category_id', $category->id)->count();
    }

    return view('admin.question_count.edit', compact('categories', 'questionCounts'));
    }

    public function update(Request $request)
    {
        $questionCounts = $request->input('question_counts');

    // Store the question counts in the session
        session(['question_counts' => $questionCounts]);

        return redirect()->route('admin.dashboard.index')->withSuccess('Question counts updated successfully.');
    }
}