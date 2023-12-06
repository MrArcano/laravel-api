<form class="d-inline-block" action="{{route($route , $element)}}" method="POST" onsubmit="return confirm('Sicuro di voler eliminare -> {{ $element->name }}?')">
    @csrf
    @method('DELETE')
    <button class="btn btn-secondary btn-custom" type="submit"><i class="fa-solid fa-trash-can"></i></button>
</form>
