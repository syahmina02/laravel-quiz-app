<form action="{{ route('admin.fitbquestions.save_selected_questions') }}" method="POST">
    @csrf

    @foreach($questions as $question)
        <div>
            <input type="checkbox" name="selected_questions[]" value="{{ $question->id }}">
            <label>{{ $question->title }}</label>
        </div>
    @endforeach

    <button type="submit">Save Selected Questions</button>
</form>