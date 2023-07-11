<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fitbquestion;
use App\Models\Fitbresult;
use App\Models\Result;
use App\Models\Question;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\ResultRequest;

class FitbresultController extends Controller
{
   
    public function index(): View
    {
        $fitbresults = Fitbresult::all();

        return view('admin.fitbresults.index', compact('fitbresults'));
    }

    public function create(): View
    {
        $fitbquestions = Fitbquestion::all()->pluck('question_text', 'id');

        return view('admin.fitbresults.create', compact('fitbquestions'));
    }

    public function store(ResultRequest $request): RedirectResponse
    {
        $fitbresult = Fitbresult::create($request->validated() + ['user_id' => auth()->id()]);
        $fitbresult->questions()->sync($request->input('fitbquestions', []));

        return redirect()->route('admin.fitbresults.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function show(Fitbresult $fitbresult): View
    {
        return view('admin.fitbresults.show', compact('fitbresult'));
    }

    public function edit(Fitbresult $fitbresult): View
    {
        $fitbquestions = Fitbquestion::all()->pluck('question_text', 'id');

        return view('admin.fitbresults.edit', compact('fitbresult', 'fitbquestions'));
    }

    public function update(ResultRequest $request, Fitbresult $fitbresult): RedirectResponse
    {
        $fitbresult->update($request->validated() + ['user_id' => auth()->id()]);
        $fitbresult->questions()->sync($request->input('fitbquestions', []));

        return redirect()->route('admin.fitbresults.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Fitbresult $fitbresult): RedirectResponse
    {
        $fitbresult->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

    public function massDestroy()
    {
        Fitbresult::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
