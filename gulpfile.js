var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.scripts([
        '/../bower_components/jquery/dist/jquery.js',
        '/../bower_components/bootstrap/dist/js/bootstrap.js',
        '/../bower_components/metisMenu/dist/metisMenu.js',
        '/../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
        '/../bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.pt-BR.min.js',
        '/../bower_components/select2/select2.js',
        '/../bower_components/markdown/lib/markdown.js',
        'page.js',
        'project.js',
        'dashboard.js',
        'login.js',
        'user.js',
        'category.js',
        'sb-admin-2.js',
    ], 'public/js/dave.js');

    mix.styles([
        '/../bower_components/bootstrap/dist/css/bootstrap.min.css',
        '/../bower_components/metisMenu/dist/metisMenu.min.css',
        '/../bower_components/font-awesome/css/font-awesome.min.css',
        '/../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
        '/../bower_components/select2/select2.css',
        '/../bower_components/select2-bootstrap/select2-bootstrap.css',
        'sb-admin-2.css',
    ], 'public/css/dave.css');

    // mix.version([
    //     'public/css/dave.css',
    //     'public/js/dave.js'
    // ]);
});
