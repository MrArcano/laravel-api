@extends('layouts.admin')

@section('content')

    @include('admin.partials.content_tecnology_type',
    [
        'title' => 'Admin Tecnology',
        'route' => 'tecnology',
        'data' => $tecnologies
    ])

@endsection
