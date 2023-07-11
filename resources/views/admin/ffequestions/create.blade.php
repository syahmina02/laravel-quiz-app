@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ __('Create Find and Fix Error Question') }}</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Question Details') }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.ffequestions.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="question_text">{{ __('question text') }}</label>
                    <input type="text" class="form-control" id="question_text" placeholder="{{ __('question text') }}" name="question_text" value="{{ old('question_text') }}" />
                </div>
                <div class="form-group">
                    <label for="compulsory_line1">{{ __('Compulsory Line 1') }}</label>
                    <input type="text" class="form-control" id="compulsory_line1" name="compulsory_line1" value="{{ old('compulsory_line1') }}" />
                </div>
                <div class="form-group">
                    <label for="compulsory_line2">{{ __('Compulsory Line 2') }}</label>
                    <input type="text" class="form-control" id="compulsory_line2" name="compulsory_line2" value="{{ old('compulsory_line2') }}" />
                </div>
                <div class="form-group">
                    <label for="optional_line1">{{ __('Optional Line 1') }}</label>
                    <input type="text" class="form-control" id="optional_line1" name="optional_line1" value="{{ old('optional_line1') }}">
                </div>
                <div class="form-group">
                    <label for="optional_line2">{{ __('Optional Line 2') }}</label>
                    <input type="text" class="form-control" id="optional_line2" name="optional_line2" value="{{ old('optional_line2') }}">
                </div>
                <div class="form-group">
                    <label for="optional_line3">{{ __('Optional Line 3') }}</label>
                    <input type="text" class="form-control" id="optional_line3" name="optional_line3" value="{{ old('optional_line3') }}">
                </div>
                <div class="form-group">
                    <label for="error_line">{{ __('Error Line') }}</label>
                    <input type="number" class="form-control" id="error_line" name="error_line" value="{{ old('error_line') }}" required>
                </div>
                <div class="form-group">
                    <label for="correct_command">{{ __('Correct Command') }}</label>
                    <input type="text" class="form-control" id="correct_command" name="correct_command" value="{{ old('correct_command') }}" required>
                </div>
                <div class="form-group">
                    <label for="category">{{ __('Category') }}</label>
                    <select class="form-control" name="category_id" id="category">
                        @foreach($categories as $id => $category)
                            <option value="{{ $id }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">{{ __('Save') }}</button>
            </form>
        </div>
    </div>

</div>
@endsection