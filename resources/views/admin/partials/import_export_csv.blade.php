@extends('layouts.admin')

@section('content')
    <div class="text-center">
        <h1 class="mb-3">IMPORT / EXPORT - Project</h1>

        @include('admin.partials.alert_success_error')

        @error('csv_file')
        <div class="alert alert-danger" role="alert">
            <p>{{$message}}</p>
        </div>
        @enderror

        <form class=" form-group" action="{{ route('admin.import-csv') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group mb-3">
                <input class=" form-control" type="file" name="csv_file" accept=".csv">
                <button class="btn btn-secondary" type="submit">Import CSV</button>
            </div>
        </form>

        <a class="btn btn-secondary" href="{{ route('admin.export-csv') }}">Export CSV</a>

    </div>
@endsection
