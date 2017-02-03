@if ($alert = Session::get('alert-success'))
    <div id="note" class="alert alert-success">
        {{ $alert }}
    </div>
@endif
@if ($alert = Session::get('alert-info'))
    <div id="note" class="alert alert-info">
        {{ $alert }}
    </div>
@endif
@if ($alert = Session::get('alert-warning'))
    <div id="note" class="alert alert-warning">
        {{ $alert }}
    </div>
@endif
@if ($alert = Session::get('alert-danger'))
    <div id="note" class="alert alert-danger">
        {{ $alert }}
    </div>
@endif
