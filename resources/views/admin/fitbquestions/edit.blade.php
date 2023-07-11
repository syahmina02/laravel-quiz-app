@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card shadow">
        <div class="card-header">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">{{ __('Edit Question')}}</h1>
                <a href="{{ route('admin.fitbquestions.index') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.fitbquestions.update', $fitbquestion->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="question_text">{{ __('Question Text') }}</label>
                    <input type="text" class="form-control" id="question_text" placeholder="{{ __('Question Text') }}" name="question_text" value="{{ old('question_text', $fitbquestion->question_text) }}" />
                </div>
                <div class="form-group">
                    <label for="answer">{{ __('Answer') }}</label>
                    <input type="text" class="form-control" id="answer" placeholder="{{ __('Answer') }}" name="answer" value="{{ old('answer', $fitbquestion->answer) }}" />
                </div>
                <div class="form-group">
                    <label for="category">{{ __('Category') }}</label>
                    <select class="form-control" name="category_id" id="category">
                        @foreach($categories as $id => $category)
                            <option {{ $id == $fitbquestion->category->id ? 'selected' : null }} value="{{ $id }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">{{ __('Save')}}</button>
            </form>
        </div>
    </div>

</div>
@endsection