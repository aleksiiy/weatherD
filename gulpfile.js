const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
elixir.config.sourcemaps = false;

elixir(function(mix) {
    mix.sass('app.scss');
    mix.sass('style.scss' , 'public/master/css/holiday.css');
    mix.sass('home.scss', 'public/master/css/home.css');
});
