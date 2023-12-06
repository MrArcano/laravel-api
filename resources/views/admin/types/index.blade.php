@extends('layouts.admin')

@section('content')

    @include('admin.partials.content_tecnology_type',
    [
        'title' => 'Admin Type',
        'route' => 'type',
        'data' => $types
    ])

@endsection

