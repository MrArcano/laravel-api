@extends('layouts.admin')

@section('content')
    <div class="project">
        {{-- @dump($_GET) --}}
        <h1 class="text-center mb-3">Admin Project</h1>

        {{-- importo gli alert, per quando viene eliminato un progetto --}}
        @include('admin.partials.alert_success_error')

        <p class="add-project"><a href="{{route('admin.project.create')}}"><i class="fa-solid fa-circle-plus"></i></a></p>
        <table class="table table-success table-striped">
            <thead>
                <tr>
                    <th scope="col">
                        <a href="{{route('admin.project.order-by',['field'=> 'id','order'=> $order])}}">#ID</a>
                    </th>
                    <th scope="col">
                        <a href="{{route('admin.project.order-by',['field'=> 'name','order'=> $order])}}">Nome</a>
                    </th>
                    <th scope="col">
                        <a href="{{route('admin.project.order-by',['field'=> 'start_date','order'=> $order])}}">Data inizio</a>
                    </th>
                    <th scope="col">Data fine</th>
                    <th scope="col">Stato</th>
                    <th scope="col">Teamwork</th>
                    <th scope="col">Type:
                        <form class=" d-inline-block m-0" id="formType" action="{{ route('admin.project.index') }}" method="GET">
                            <select class="bg-transparent border-0" onchange="filterType()" id="type_id" name="type_id">
                                <option value="">All</option>
                                @foreach ($types as $type)
                                    <option {{ $type_id_form == $type->id ? 'selected' : '' }} value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </form>

                    </th>
                    <th>Tecnology</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <th scope="row">{{$project->id}}</th>
                        <td>{{$project->name}}</td>
                        @php
                            $start_date = date_create($project->start_date);
                            if($project->end_date){
                                $end_date = date_create($project->end_date);
                            }else {
                                $end_date = $project->end_date;
                            }
                        @endphp

                        <td>{{date_format($start_date,'d/m/Y')}}</td>
                        <td>{{$end_date ? date_format($end_date,'d/m/Y') : '-'}}</td>
                        <td>{{$project->status}}</td>
                        <td>{{$project->is_group_project}}</td>
                        <td>
                            @if ($project->type)
                                <span class="badge text-bg-dark">{{$project->type->name}}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @forelse ($project->tecnologies as $tecnology)
                                <a href="{{route('admin.tecnology.projects-tecnology',$tecnology)}}" class="badge text-bg-info text-decoration-none">{{$tecnology->name}}</a>
                            @empty
                                <a href="{{route('admin.project.no-tecnology')}}" class="badge text-bg-warning text-decoration-none">No Tecnology</a>
                            @endforelse
                        </td>
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
        <div class="pagination-custom">
            {{ $projects->links() }}
        </div>
    </div>

    <script>
        function filterType(){
            const formType = document.getElementById("formType");
            formType.submit();
        }
    </script>

@endsection
