@extends('layouts.admin')

@section('content')
    <div class="project-create">
        <h1 class="text-center mb-5">{{$title}}</h1>

        <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)

            <div class="row">
                <div class="col-12 col-md-6 col-lg-8">
                    {{-- sezione dati testuali --}}
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="mb-3">
                                {{-- Titolo progetto --}}
                                <label for="name" class="form-label fw-bold">Titolo progetto: *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name',$project?->name) }}">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                {{-- Stato del progetto --}}
                                <label for="status" class="form-label fw-bold">Stato: </label>
                                <select id="status" class="form-select @error('status') is-invalid @enderror" name="status">
                                    <option {{ old('status',$project?->status) === 'In corso' ? 'selected' : '' }} value="In corso">In corso</option>
                                    <option {{ old('status',$project?->status) === 'Completato' ? 'selected' : '' }} value="Completato">Completato</option>
                                    <option {{ old('status',$project?->status) === 'Sospeso' ? 'selected' : '' }} value="Sospeso">Sospeso</option>
                                </select>
                                @error('status')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                {{-- Data inizio --}}
                                <label for="start_date" class="form-label fw-bold">Data inizio: *</label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date',$project?->start_date) }}">
                                @error('start_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                {{-- Data fine --}}
                                <label for="end_date" class="form-label fw-bold">Data fine: </label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date',$project?->end_date) }}">
                                @error('end_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                {{-- Flag lavoro di gruppo --}}
                                <label for="is_group_project" class="form-label fw-bold">Lavoro di gruppo: </label>
                                <select id="is_group_project" class="form-select @error('is_group_project') is-invalid @enderror" name="is_group_project">
                                    <option {{ old('is_group_project',$project?->is_group_project) === 'No' ? 'selected' : '' }} value="No">No</option>
                                    <option {{ old('is_group_project',$project?->is_group_project) === 'Sì' ? 'selected' : '' }} value="Sì">Si</option>
                                </select>
                                @error('is_group_project')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                {{-- Tipi --}}
                                <div>
                                    <label class="form-label fw-bold">Tipi: </label>
                                </div>

                                <input type="radio" checked class="btn-check" id="type-0" value="" name="type_id" >
                                <label class="btn btn-outline-info badge" for="type-0">No type</label>
                                @foreach ($types as $type)
                                    <input
                                        type="radio"
                                        {{ old('type_id',$project?->type?->id) === $type->id ? 'checked' : '' }}
                                        class="btn-check"
                                        id="type-{{ $type->id }}"
                                        value="{{$type->id}}"
                                        name="type_id">
                                    <label class="btn btn-outline-info badge" for="type-{{ $type->id }}">{{$type->name}}</label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                {{-- Tecnologie --}}
                                <div>
                                    <label class="form-label fw-bold">Tecnologie: </label>
                                </div>
                                @foreach ($tecnologies as $tecnology)
                                    <input
                                        type="checkbox"
                                        class="btn-check"
                                        id="tecnology-{{ $tecnology->id }}"
                                        value="{{ $tecnology->id }}"
                                        {{-- $errors->count() mi restituisce quanti errori ci sono stati --}}
                                        {{-- se non ci sono errori, devo checkare solo se mi trovo nell'edit --}}
                                        @if(!$errors->count() && $project?->tecnologies->contains( $tecnology->id ) ) checked @endif
                                        {{-- se ci sono errori, devo checkare i vecchi elementi passati dall'old --}}
                                        @if($errors->count() && in_array($tecnology->id,old('tecnologies'))) checked @endif
                                        name="tecnologies[]">
                                    <label class="btn btn-outline-info badge" for="tecnology-{{ $tecnology->id }}">{{ $tecnology->name }}</label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                {{-- Descrizione --}}
                                <label for="description" class="form-label fw-bold">Descrizione: *</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3" name="description">{{ old('description',$project?->description) }}</textarea>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>




                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    {{-- sezione immagine --}}
                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Immagine: </label>

                            <div class="mb-3 position-relative">
                                <img
                                    id="image-preview"
                                    class="img-fluid rounded"
                                    onerror="this.src ='/img/placeholder.png'"
                                    src="{{ asset('storage/'. $project?->image ) }}"
                                    alt="{{ $project?->image_name }}">
                                @if ($project)
                                    <a class="btn btn-secondary position-absolute end-0 top-0" href="{{ route('admin.project.delete-image', $project)}}"><i class="fa-solid fa-xmark"></i></a>
                                @endif
                            </div>

                        <input onchange="previewImage(event)" type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>



            <div class="d-flex justify-content-center">
                <button class="btn btn-secondary w-100 fs-3  btn-custom" type="submit">Salva</button>
            </div>

        </form>
    </div>

    <script>
        function previewImage(event){
            const imagePreview = document.getElementById('image-preview');
            imagePreview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>


@endsection
