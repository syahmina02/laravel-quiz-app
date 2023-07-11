@extends('layouts.client')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Fill-in-the-Blank Test</div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Same layout structure as the previous test view -->
                    <!-- Replace the form with the following code -->
                    <form method="POST" action="{{ route('client.fitbtest.store') }}">
                        @csrf
                        @foreach($categories as $category)
                            @foreach($category->categoryFitbQuestions as $fitbquestion)
                                <div class="card mb-3">
                                    <div class="card-header">{{ $fitbquestion->question_text }}</div>

                                    <div class="card-body">
                                        <input type="hidden" name="answers[{{ $fitbquestion->id }}]" value="">
                                        <div class="form-group">
                                            <input type="text" name="answers[{{ $fitbquestion->id }}]" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach

                        <!-- Add a submit button -->
                        <div class="form-group row mb-0">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection