<?php

namespace App\Http\Controllers\Admin;

use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\OptionRequest;
use App\Models\Fitboption;
use App\Models\Fitbquestion;

class FitboptionController extends Controller
{
   
    public function index(): View
    {
        $options = Fitboption::all();

        return view('admin.fitboptions.index', compact('options'));
    }

    public function create(): View
    {
        $questions = Fitbquestion::all()->pluck('question_text', 'id');

        return view('admin.fitboptions.create', compact('questions'));
    }

    public function store(OptionRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['fitbquestion_id'] = $request->input('question_id');

        Fitboption::create($data);

        return redirect()->route('admin.fitboptions.index')->with([
            'message' => 'Successfully created!',
            'alert-type' => 'success'
        ]);
    }

    public function show(Fitboption $option): View
    {
        return view('admin.fitboptions.show', compact('option'));
    }

    public function edit(Fitboption $option): View
    {
        $questions = Fitbquestion::all()->pluck('question_text', 'id');

        return view('admin.fitboptions.edit', compact('option', 'questions'));
    }

    public function update(OptionRequest $request, Fitboption $option): RedirectResponse
    {
        $option->update($request->validated());

        return redirect()->route('admin.fitboptions.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Fitboption $option): RedirectResponse
    {
        $option->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

    public function massDestroy()
    {
        Fitboption::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
