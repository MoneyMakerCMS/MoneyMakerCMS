const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

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

elixir(mix => {
    mix.sass('app.scss', 'public/stylesheets/frontend/styles.css')
        .webpack('app.js', 'public/javascript/frontend/app.js');
});

/*
* 
*/

elixir(mix => {
    mix.sass('admin/bootstrap/bootstrap.scss', 'public/stylesheets/admin/styles.css')
        .webpack([
            'admin/app.js',
        ], 'public/javascript/admin/app.js')

		.scripts([
            './node_modules/jquery/dist/jquery.js',
            './node_modules/bootstrap/dist/js/bootstrap.js'
        ], 'public/javascript/admin/vendor.js')
});

/*
* Fonts 
*/
elixir(mix => {
    mix.copy('node_modules/font-awesome/fonts', 'public/fonts/font-awesome')
        .copy('node_modules/bootstrap-sass/assets/fonts/bootstrap', 'public/fonts/bootstrap')
});
