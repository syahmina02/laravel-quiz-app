<?php

namespace App\Http\Controllers;

use App\Models\Fitbresult;
use App\Models\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FitbresultController extends Controller
{
    public function show($result_id)
    {
        $result = Fitbresult::where('user_id', auth()->id())->findOrFail($result_id);

        return view('client.fitbresults', compact('result'));
    }
    public function next()
    {
        // Logic for the next page

        return view('client.next');
    }

    public function test()
    {
        return redirect()->route('client.fitbtest');
    }
}