const elixir = require('laravel-elixir');
require('es6-promise').polyfill();

elixir(function (mix) {
    mix.sass([
        'resources/assets/sass/base.scss'
    ], 'public/css/');

    mix.copy('resources/assets/css/fonts', 'public/css/fonts');
    mix.copy('resources/assets/css/themes', 'public/css/themes');
    mix.copy('resources/assets/img', 'public/img');
    mix.copy('resources/assets/js', 'public/js');

    mix.styles([
        'resources/assets/css/plugins.css',
        'resources/assets/css/main.css',
        'resources/assets/css/themes.css',
    ], 'public/css/templates.css');
});
