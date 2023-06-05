@extends('layouts.admin')

@section('content')
    <h1>Manage Test Questions</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.test.update') }}" method="POST">
        @csrf

        <table class="table">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Randomized Question Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
                            <input type="number" name="category_questions[{{ $category->id }}]" value="{{ $category->question_count }}" min="0">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Update Question Counts</button>
    </form>
@endsection