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
        $fitboptions = Fitboption::all();

        return view('admin.fitboptions.index', compact('fitboptions'));
    }

    public function create(): View
    {
        $fitbquestions = Fitbquestion::all()->pluck('question_text', 'id');

        return view('admin.fitboptions.create', compact('fitbquestions'));
    }

    public function store(OptionRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['fitbquestion_id'] = $request->input('fitbquestion_id');

        Fitboption::create($data);

        return redirect()->route('admin.fitboptions.index')->with([
            'message' => 'Successfully created!',
            'alert-type' => 'success'
        ]);
    }

    public function show(Fitboption $fitboption): View
    {
        return view('admin.fitboptions.show', compact('fitboption'));
    }

    public function edit(Fitboption $fitboption): View
    {
        $fitbquestions = Fitbquestion::all()->pluck('question_text', 'id');

        return view('admin.fitboptions.edit', compact('fitboption', 'fitbquestions'));
    }

    public function update(OptionRequest $request, Fitboption $fitboption): RedirectResponse
    {
        $fitboption->update($request->validated());

        return redirect()->route('admin.fitboptions.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Fitboption $fitboption): RedirectResponse
    {
        $fitboption->delete();

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
