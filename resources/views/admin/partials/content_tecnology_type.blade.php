<h1 class="text-center mb-3">{{ $title }}</h1>
<div class="row justify-content-center">
    <div class="col-6">

        {{-- Alert with session --}}
        @include('admin.partials.alert_success_error')

        {{-- Alert validation --}}
        @error('name')
            <div class="alert alert-danger" role="alert">
                <p>{{ $message }}</p>
            </div>
        @enderror

        <form action="{{route('admin.'.$route.'.store')}}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Add new {{ $route }}" name="name">
                <button class="btn btn-secondary btn-custom" type="submit" id="button-addon2">Add</button>
            </div>
        </form>

        <div class="pagination-custom my-2">
            {{ $data->links() }}
        </div>

        <table class="table table-success table-striped">
            <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>
                            <form id="edit-form-{{$item->id}}" method="POST" action="{{ route('admin.'.$route.'.update' , $item) }}">
                                @csrf
                                @method('PUT')
                                <input class="form-hidden" type="text" name="name" value="{{ $item->name }}">
                            </form>
                        </td>
                        <td>
                            <button onclick="edit_submit({{ $item->id }})" class="btn btn-secondary btn-custom"><i class="fa-solid fa-pencil"></i></button>
                            @include('admin.partials.delete_form',
                            [
                                'route' => 'admin.'.$route.'.destroy',
                                'element' => $item,
                                ])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

<script>
    function edit_submit(id){
        const edit_form = document.getElementById("edit-form-" + id);
        edit_form.submit();
    }
</script>
