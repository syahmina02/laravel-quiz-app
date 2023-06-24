<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fitbquestion;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\QuestionRequest;
use App\Models\Category;

class FitbquestionController extends Controller
{
   
    public function index(): View
    {
        $questions = Fitbquestion::all();

        return view('admin.fitbquestions.index', compact('questions'));
    }

    public function create(): View
    {
        $categories = Category::all()->pluck('name', 'id');

        return view('admin.fitbquestions.create', compact('categories'));
    }

    public function store(QuestionRequest $request): RedirectResponse
    {
        Fitbquestion::create($request->validated());

        return redirect()->route('admin.fitbquestions.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function show(Fitbquestion $question): View
    {
        return view('admin.fitbquestions.show', compact('question'));
    }

    public function edit(Fitbquestion $fitbquestion): View
    {
        $categories = Category::all()->pluck('name', 'id');

        return view('admin.fitbquestions.edit', compact('fitbquestion', 'categories'));
    }

    public function update(QuestionRequest $request, Fitbquestion $fitbquestion): RedirectResponse
    {
        $fitbquestion->update($request->validated());

        return redirect()->route('admin.fitbquestions.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Fitbquestion $fitbquestion): RedirectResponse
    {
        $fitbquestion->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

    public function massDestroy()
    {
        Fitbquestion::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
