@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show mt-1" role="alert">
    <p>{{ $message }}</>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif