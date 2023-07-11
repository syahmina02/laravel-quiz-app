<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ffequestion;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\QuestionRequest;
use App\Models\Category;

class FfequestionController extends Controller
{
    public function index(): View
    {
        $questions = Ffequestion::all();

        return view('admin.ffequestions.index', compact('questions'));
    }

    public function create(): View
    {
        $categories = Category::all()->pluck('name', 'id');

        return view('admin.ffequestions.create', compact('categories'));
    }

    public function store(QuestionRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $validatedData['compulsory_line1'] = $request->input('compulsory_line1');
        $validatedData['compulsory_line2'] = $request->input('compulsory_line2');
        $validatedData['optional_line1'] = $request->input('optional_line1');
        $validatedData['optional_line2'] = $request->input('optional_line2');
        $validatedData['optional_line3'] = $request->input('optional_line3');
        $validatedData['error_line'] = $request->input('error_line');
        $validatedData['correct_command'] = $request->input('correct_command');

        $ffequestion = new Ffequestion($validatedData);
        $ffequestion->save();

        return redirect()->route('admin.ffequestions.index')->with([
            'message' => 'Successfully created!',
            'alert-type' => 'success'
        ]);
    }

    public function show(Ffequestion $question): View
    {
        return view('admin.ffequestions.show', compact('question'));
    }

    public function edit(Ffequestion $ffequestion): View
    {
        $categories = Category::all()->pluck('name', 'id');

        return view('admin.ffequestions.edit', compact('ffequestion', 'categories'));
    }

    public function update(QuestionRequest $request, Ffequestion $ffequestion): RedirectResponse
    {
        $validatedData = $request->validated();
        $validatedData['compulsory_line1'] = $request->input('compulsory_line1');
        $validatedData['compulsory_line2'] = $request->input('compulsory_line2');
        $validatedData['optional_line1'] = $request->input('optional_line1');
        $validatedData['optional_line2'] = $request->input('optional_line2');
        $validatedData['optional_line3'] = $request->input('optional_line3');
        $validatedData['error_line'] = $request->input('error_line');
        $validatedData['correct_command'] = $request->input('correct_command');

        $ffequestion->update($validatedData);

        return redirect()->route('admin.ffequestions.index')->with([
            'message' => 'Successfully updated!',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Ffequestion $ffequestion): RedirectResponse
    {
        $ffequestion->delete();

        return back()->with([
            'message' => 'Successfully deleted!',
            'alert-type' => 'danger'
        ]);
    }

    public function massDestroy()
    {
        Ffequestion::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}