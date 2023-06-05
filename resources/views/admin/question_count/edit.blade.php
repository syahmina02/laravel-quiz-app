@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            Edit Question Counts
        </div>

        <div class="card-body">
            <form action="{{ route('admin.question_count.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="question_counts">Question Counts</label>
                    @foreach ($categories as $category)
                        <div class="form-group">
                            <label for="category_{{ $category->id }}">{{ $category->name }}</label>
                            <input type="number" name="question_counts[{{ $category->id }}]" id="category_{{ $category->id }}" class="form-control" value="{{ $questionCounts[$category->id] }}">
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection