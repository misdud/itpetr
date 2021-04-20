@if (session('message_info' ?? 'status'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session('message_info' ?? 'status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif