@extends('layouts.client')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Results of your test</div>

                <div class="card-body">
                    <p class="mt-5">Total points: {{ $result->total_points }} points</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Question Text</th>
                                <th>Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($result->questions as $question)
                                <tr>
                                    <td>{{ $question->question_text }}</td>
                                    <td>{{ $question->pivot->points }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        @if ($result->total_points == count($result->questions))
                            <a href="{{ route('client.test') }}" class="btn btn-primary">Next</a>
                        @else
                            <a href="{{ route('client.test') }}" class="btn btn-secondary">Retry</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection