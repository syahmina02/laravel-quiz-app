<form action="{{ route('admin.create.index') }}" method="GET">
    @foreach ($categories as $category)
        <label for="{{ $category->id }}">{{ $category->name }}</label>
        <input type="number" name="number_of_questions[{{ $category->id }}]" value="0" min="0">
    @endforeach
    <button type="submit">Submit</button>
</form>