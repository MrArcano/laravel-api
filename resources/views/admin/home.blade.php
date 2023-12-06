@extends('layouts.admin')

@section('content')
    <h1 class="text-center mb-3">Dashboard</h1>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-4 mb-4">
                <div class="card-csm blue">
                    <div class="title">Projects</div>
                    <div class="value">{{ $projects_count }}</div>
                    <div class="stat"><a href="{{ route('admin.project.index') }}">Go to list</a></div>
                </div>
            </div>
            <div class="col-12 col-lg-4 mb-4">
                <div class="card-csm green">
                    <div class="title">Tecnologies</div>
                    <div class="value">{{ $tecnologies_count }}</div>
                    <div class="stat"><a href="{{ route('admin.tecnology.index') }}">Go to list</a></div>
                </div>
            </div>
            <div class="col-12 col-lg-4 mb-4">
                <div class="card-csm orange">
                    <div class="title">Type</div>
                    <div class="value">{{ $types_count }}</div>
                    <div class="stat"><a href="{{ route('admin.type.index') }}">Go to list</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
