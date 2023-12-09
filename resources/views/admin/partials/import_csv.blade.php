@extends('layouts.admin')

@section('content')
    <h1>IMPORT</h1>
    <form action="{{ route('admin.import-csv') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input class=" form-control" type="file" name="file" accept=".csv">
        <button class="btn btn-secondary" type="submit">Import CSV</button>
    </form>

    <a href="{{ route('admin.export-csv') }}">Export CSV</a>
@endsection
