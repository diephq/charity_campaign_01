@if ($alert = Session::get('alert-success'))
    <div class="alert alert-success">
        {{ $alert }}
    </div>
@endif
@if ($alert = Session::get('alert-info'))
    <div class="alert alert-info">
        {{ $alert }}
    </div>
@endif
@if ($alert = Session::get('alert-warning'))
    <div class="alert alert-warning">
        {{ $alert }}
    </div>
@endif
@if ($alert = Session::get('alert-danger'))
    <div class="alert alert-danger">
        {{ $alert }}
    </div>
@endif
