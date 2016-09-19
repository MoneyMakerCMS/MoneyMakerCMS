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

// elixir(mix => {
//     mix.sass('app.scss', 'public/stylesheets/frontend/styles.css')
//         .webpack('app.js', 'public/javascript/frontend/app.js');
// });

/*
 * 
 */

elixir(mix => {

    mix.sass([
        'admin/app.scss'
    ], './resources/assets/css/admin/styles.css')

    .styles([
        'admin/styles.css',
        './node_modules/admin-lte/dist/css/AdminLTE.css',
        './node_modules/admin-lte/dist/css/skins/skin-black-light.css',
        './node_modules/datatables.net-bs/css/dataTables.bootstrap.css'
    ], 'public/stylesheets/admin/styles.css')

    .webpack([
        'admin/app.js',
    ], './resources/assets/js/admin/bundle.js')

    .scripts([
        './node_modules/jquery/dist/jquery.js',
        './node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
        './node_modules/datatables.net/js/jquery.dataTables.js',
        './node_modules/datatables.net-bs/js/dataTables.bootstrap.js',
        'admin/bundle.js'
    ], 'public/javascript/admin/app.js')
});

elixir(mix => {
    mix.version([
        'stylesheets/admin/styles.css',
        'javascript/admin/app.js'
    ]);
});
/*
 * Fonts 
 */
elixir(mix => {
    mix
        .copy('node_modules/font-awesome/fonts', 'public/fonts/font-awesome')
        .copy('node_modules/bootstrap-sass/assets/fonts/bootstrap', 'public/fonts/bootstrap')
});
