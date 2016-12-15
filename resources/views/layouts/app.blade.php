<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('message.project') }}</title>

    @section('css')
        {{ Html::style('bower_components/bootstrap/dist/css/bootstrap.min.css') }}
        {{ Html::style('bower_components/bootstrap-social/bootstrap-social.css') }}
        {{ Html::style('css/common.css') }}
        {{ Html::style('https://fonts.googleapis.com/css?family=Open+Sans:300,400,700%7CLato:700,900&subset=latin,latin') }}
        {{ Html::style('http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') }}
    @show

</head>
<body>

    @include('layouts.header')

    @include('layouts.alert')

    @yield('content')

    @include('layouts.footer')

    @section('js')
        {{ Html::script('bower_components/jquery/dist/jquery.min.js') }}
        {{ Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js') }}
    @show

</body>
</html>
