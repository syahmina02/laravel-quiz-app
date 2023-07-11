@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card shadow">
        <div class="card-header">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">{{ __('Edit Question')}}</h1>
                <a href="{{ route('admin.ffequestions.index') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.ffequestions.update', $ffequestion->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="question_text">{{ __('Compulsory Line 1') }}</label>
                    <input type="text" class="form-control" id="question_text" name="question_text" value="{{ old('question_text', $ffequestion->question_text) }}" required>
                </div>
                <div class="form-group">
                    <label for="compulsory_line1">{{ __('Compulsory Line 1') }}</label>
                    <input type="text" class="form-control" id="compulsory_line1" name="compulsory_line1" value="{{ old('compulsory_line1', $ffequestion->compulsory_line1) }}" required>
                </div>
                <div class="form-group">
                    <label for="compulsory_line2">{{ __('Compulsory Line 2') }}</label>
                    <input type="text" class="form-control" id="compulsory_line2" name="compulsory_line2" value="{{ old('compulsory_line2', $ffequestion->compulsory_line2) }}" required>
                </div>
                <div class="form-group">
                    <label for="optional_line1">{{ __('Optional Line 1') }}</label>
                    <input type="text" class="form-control" id="optional_line1" name="optional_line1" value="{{ old('optional_line1', $ffequestion->optional_line1) }}">
                </div>
                <div class="form-group">
                    <label for="optional_line2">{{ __('Optional Line 2') }}</label>
                    <input type="text" class="form-control" id="optional_line2" name="optional_line2" value="{{ old('optional_line2', $ffequestion->optional_line2) }}">
                </div>
                <div class="form-group">
                    <label for="optional_line3">{{ __('Optional Line 3') }}</label>
                    <input type="text" class="form-control" id="optional_line3" name="optional_line3" value="{{ old('optional_line3', $ffequestion->optional_line3) }}">
                </div>
                <div class="form-group">
                    <label for="error_line">{{ __('Error Line') }}</label>
                    <input type="number" class="form-control" id="error_line" name="error_line" value="{{ old('error_line', $ffequestion->error_line) }}" required>
                </div>
                <div class="form-group">
                    <label for="correct_command">{{ __('Correct Command') }}</label>
                    <input type="text" class="form-control" id="correct_command" name="correct_command" value="{{ old('correct_command', $ffequestion->correct_command) }}" required>
                </div>
                <div class="form-group">
                    <label for="category">{{ __('Category') }}</label>
                    <select class="form-control" name="category_id" id="category">
                        @foreach($categories as $id => $category)
                            <option {{ $id == $ffequestion->category->id ? 'selected' : null }} value="{{ $id }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">{{ __('Save')}}</button>
            </form>
        </div>
    </div>

</div>
@endsection