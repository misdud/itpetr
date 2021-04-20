@if (session('msgIdentical' ?? 'Одиноковы значения'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session('msgIdentical' ?? 'Одиноковы значения') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif