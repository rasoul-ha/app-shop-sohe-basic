@if ($errors->any())
@foreach ($errors->all() as $error )
<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    {{$error}}
</div>
@endforeach
@endif
