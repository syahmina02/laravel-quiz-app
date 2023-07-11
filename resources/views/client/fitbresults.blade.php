@extends('layouts.client')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">FITB Results of your test</div>

                <div class="card-body">
                    <p class="mt-5">Total points: {{ $result->total_points }} points</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Question Text</th>
                                <th>Answer</th>
                                <th>Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($result->fitbquestions as $fitbquestion)
                                <tr>
                                    <td>{{ $fitbquestion->question_text }}</td>
                                    <td>{{ $fitbquestion->pivot->answer }}</td>
                                    <td>{{ $fitbquestion->pivot->points }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        @if ($result->total_points == count($result->fitbquestions))
                            <a href="{{ route('client.fitbtest') }}" class="btn btn-primary">Next</a>
                        @else
                            <a href="{{ route('client.fitbtest') }}" class="btn btn-secondary">Retry</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection