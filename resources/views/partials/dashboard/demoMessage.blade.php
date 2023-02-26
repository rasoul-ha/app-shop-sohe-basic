@if (session('demo_message'))
<div class="alert alert-warning alert-dismissible bg-warning text-white border-0 fade show" role="alert">
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
{{session('demo_message')}}
</div>
@endif
