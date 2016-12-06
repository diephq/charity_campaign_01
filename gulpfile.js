const elixir = require('laravel-elixir');
require('es6-promise').polyfill();

elixir(function (mix) {
    mix.sass('resources/assets/sass/common.scss', 'public/css/common.css');
});
