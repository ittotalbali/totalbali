@if (Session::has('notif'))
    @php
        if (Session::get('notif_status') == '1') {
            $notif_class = 'success';
        } elseif (Session::get('notif_status') == '0') {
            $notif_class = 'danger';
        } else {
            $notif_class = 'warning';
        }
    @endphp
    <div class="alert alert-fill-{{ $notif_class }}" role="alert">
        {{ Session::get('notif') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
    </div>
@endif