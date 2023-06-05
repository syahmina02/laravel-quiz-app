<form action="{{ route('test.submit') }}" method="POST">
    @csrf

    <!-- Display categories and number of questions for each category options -->
    @foreach($categories as $category)
        <h3>{{ $category->name }}</h3>
        <div>
            <label for="category-{{ $category->id }}">Number of Questions:</label>
            <input type="number" name="questions_per_category[{{ $category->id }}]" id="category-{{ $category->id }}" min="1" max="{{ $category->questions->count() }}">
        </div>
    @endforeach

    <button type="submit">Submit</button>
</form>