<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('message.project') }}</title>

    @section('css')
        {{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css') }}
        {{ Html::style('https://cdn.datatables.net/1.10.13/css/dataTables.material.min.css') }}
        {{ Html::style('bower_components/bootstrap/dist/css/bootstrap.min.css') }}
        {{ Html::style('bower_components/bootstrap-social/bootstrap-social.css') }}
        {{ Html::style('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700') }}
        {{ Html::style('http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') }}
        {{ Html::style('css/templates.css') }}
        {{ Html::style('css/app.css') }}
        {{ Html::style('bower_components/bootstrap-material-design/dist/bootstrap-material-design.css') }}
    @show

</head>
<body>
    <div id="page-wrapper">
        <div id="page-container">
            <div id="main-container">

                @include('layouts.header')

                @include('layouts.alert')

                @yield('content')

                @include('layouts.footer')

            </div>
        </div>
    </div>

    @section('js')
        {{ Html::script('bower_components/jquery/dist/jquery.min.js') }}
        {{ Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js') }}
        {{ Html::script('js/plugins.js') }}
        {{ Html::script('js/app.js') }}
        {{ Html::script('js/base.js') }}
        {{ Html::script('https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js') }}
        {{ Html::script('https://cdn.datatables.net/1.10.13/js/dataTables.material.min.js') }}
        {{ Html::script('bower_components/typeahead.js/dist/typeahead.bundle.min.js') }}
        {{ Html::script('js/search.js') }}
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery(document).ready(function($) {
                var search = new Search();
                search.init();
            });
        </script>
    @show

</body>
</html>
