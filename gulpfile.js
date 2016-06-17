var elixir = require('laravel-elixir');

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

elixir(function(mix) {
    mix.sass('app.scss')
        .version(['public/css/app.css']);
});



elixir(function(mix) {
    mix.scripts(['functions.js'], 'public/js/all.js')
        .scripts(['map_show_view.js'], 'public/js/maps_show.js');
});

/*
elixir(function(mix){
    mix.copy([
            'node_modules/bootstrap-sass/assets/fonts/bootstrap/'],
        'public/build/fonts/bootstrap'
    );
});
*/





