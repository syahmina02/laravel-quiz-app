<!-- resources/views/excel/form.blade.php -->

<form method="POST" action="{{ route('import.process') }}" enctype="multipart/form-data">
    @csrf

    <div>
        <label for="excel_file">Select Excel File:</label>
        <input type="file" id="excel_file" name="excel_file">
    </div>

    <button type="submit">Import</button>
</form>