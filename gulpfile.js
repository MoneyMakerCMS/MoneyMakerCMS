const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

elixir(mix => {
    mix
    .phpUnit('phpunit.xml')
    .browserSync({
        proxy: 'moneymakercms.dev'
    })
    .sass([
        'admin/app.scss'
    ], './resources/assets/css/admin/styles.css')

    .styles([
        'admin/styles.css',
        './node_modules/sweetalert/dist/sweetalert.css',
        './node_modules/admin-lte/dist/css/AdminLTE.css',
        './node_modules/admin-lte/dist/css/skins/skin-black-light.css',
        './node_modules/datatables.net-bs/css/dataTables.bootstrap.css'
    ], 'public/stylesheets/admin/styles.css')

    .webpack([
        'admin/app.js',
    ], './resources/assets/js/admin/bundle.js')

    .scripts([
        '../../../node_modules/vue/dist/vue.js',
        '../../../node_modules/vue-resource/dist/vue-resource.js',
        '../../../node_modules/selectize/dist/js/standalone/selectize.js',
        'admin/slugify.js',
        'admin/content/content.js',

    ], 'public/javascript/admin/content.js')

    .styles([
        '../../../node_modules/selectize/dist/css/selectize.bootstrap3.css'

    ], 'public/stylesheets/admin/content.css')


    .scripts([
        '../../../node_modules/vue/dist/vue.js',
        '../../../node_modules/vue-resource/dist/vue-resource.js',
        '../../../node_modules/selectize/dist/js/standalone/selectize.js',
        'admin/slugify.js',
        'admin/pages/pages.js',

    ], 'public/javascript/admin/pages.js')

    .styles([
        '../../../node_modules/selectize/dist/css/selectize.bootstrap3.css'

    ], 'public/stylesheets/admin/pages.css')

    .scripts([
        './node_modules/jquery/dist/jquery.js',
        './node_modules/sweetalert/dist/sweetalert.min.js',
        './node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
        './node_modules/datatables.net/js/jquery.dataTables.js',
        './node_modules/datatables.net-bs/js/dataTables.bootstrap.js',
        'admin/bundle.js'
    ], 'public/javascript/admin/app.js')
});

/*
 * Version 
 */
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
