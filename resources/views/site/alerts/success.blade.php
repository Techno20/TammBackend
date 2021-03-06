@if (session('success'))
<div class="alert alert-success text-center" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    {{ session('success') }}
</div>
@endif
