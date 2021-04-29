@if (session('message_info' ?? 'off'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session('message_info' ?? 'off') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif