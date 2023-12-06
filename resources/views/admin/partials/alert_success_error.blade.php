
@if(session('error'))
<div class="alert alert-danger" role="alert">
    <p>{{session('error')}}</p>
</div>
@endif

@if (session('success'))
    <div class="alert alert-success" role="alert">
        <p>{{session('success')}}</p>
    </div>
@endif
