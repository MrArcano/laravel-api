@extends('layouts.admin')

@section('content')
    <p>Lista progetti che usano la tecnologia: <strong>{{ $tecnology->name }}</strong></p>

    <table class="table table-success table-striped">
        <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($tecnology->projects as $project)
                <tr>
                    <th scope="row">{{ $project->id }}</th>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->description }}</td>
                    <td>
                        <a class="btn btn-secondary btn-custom" href="{{route('admin.project.show',$project)}}"><i class="fa-solid fa-eye"></i></a>

                            <a class="btn btn-secondary btn-custom" href="{{route('admin.project.edit',$project)}}"><i class="fa-solid fa-pencil"></i></a>
                            @include('admin.partials.delete_form',
                                [
                                    'route' => 'admin.project.destroy',
                                    'element' => $project,
                                    ])

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
