@extends('layouts.admin')
@section('content')
<form method="POST" action="{{ url('/import') }}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="excel_file">
    <button type="submit">Import</button>
</form>
@endsection