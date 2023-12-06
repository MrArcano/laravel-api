@extends('layouts.admin')

@section('content')
    <div class="show">
        <div class="card-wrapper">
            <div class="card-csm">
                <div class="card-front">
                    <div class="layer">
                        <div class="corner"></div>
                        <div class="corner"></div>
                        <div class="corner"></div>
                        <div class="corner"></div>

                        <div class="p-3">
                            {{-- ------------------------------------ --}}
                            <div class="row mb-3">
                                <div class="col-12 text-center">
                                    <h2 class="d-inline-block">{{ $project->name }}</h2>
                                    <span class="badge text-bg-warning ms-3">{{ $project->status }}</span>
                                </div>
                            </div>

                            <div class="row">
                                @if($project?->image)
                                    <div class="col-4">
                                        <img class="img-fluid rounded" src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->image_name }}">
                                    </div>
                                @endif

                                <div class="{{ $project?->image ? 'col-8' : 'col-12' }} ">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <strong>Descrizione: </strong>{{ $project->description }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-auto mb-2">
                                            <strong>Type:</strong>
                                            @if ($project->type)
                                                <span class="badge text-bg-info">{{ $project->type->name }}</span>
                                            @else
                                                <span class="badge text-bg-warning">No Type</span>
                                            @endif
                                        </div>
                                        <div class="col-auto mb-2">
                                            <strong>Tecnology:</strong>
                                            @forelse ($project->tecnologies as $tecnology)
                                                <span class="badge text-bg-info">{{$tecnology->name}}</span>
                                            @empty
                                                <span class="badge text-bg-warning">No Tecnology</span>
                                            @endforelse
                                        </div>
                                        <div class="col-auto mb-2">
                                            Dal <strong>{{ $project->start_date }}</strong> al <strong>{{ $project->end_date ? $project->end_date : 'in corso'}}</strong>
                                        </div>
                                    </div>
                                    <p></p>


                                </div>
                            </div>

                            <div class="row">
                                <p>



                                </p>


                            </div>
                            {{-- ------------------------------------ --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>








    </div>
@endsection
