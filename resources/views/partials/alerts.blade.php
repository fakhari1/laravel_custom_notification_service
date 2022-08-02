<div class="d-block w-50 mx-auto">
    @if(session('success_msg'))
        <div class="alert alert-success">{{ session('success_msg') }}</div>
    @endif

    @if(session('error_msg'))
        <div class="alert alert-danger">{{ session('error_msg') }}</div>
    @endif
</div>
