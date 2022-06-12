const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
// mix.scripts('resources/js/admin/charts-bars.js', 'public/js/admin/charts-bars.js')
// mix.scripts('resources/js/admin/charts-lines.js', 'public/js/admin/charts-lines.js')
// mix.scripts('resources/js/admin/charts-pie.js', 'public/js/admin/charts-pie.js')
// mix.scripts('resources/js/admin/focus-trap.js', 'public/js/admin/focus-trap.js')
// mix.scripts('resources/js/admin/init-alpine.js', 'public/js/admin/init-alpine.js')
mix.scripts([
    'resources/js/admin/init-alpine.js',
    'resources/js/admin/charts-lines.js',
    'resources/js/admin/charts-pie.js',
    'resources/js/admin/charts-bars.js',
    'resources/js/admin/focus-trap.js',
], 'public/js/admin/admin.js')
    .postCss('resources/css/app.css', 'public/css', [
        require("tailwindcss"),
    ]);
mix.copyDirectory('resources/img/admin', 'public/img/admin');

mix.copyDirectory('resources/assets/admin/plugins/fontawesome-free/webfonts', 'public/assets/admin/webfonts');

mix.styles([
    'resources/assets/front/css/bootstrap.css',
    'resources/assets/front/css/font-awesome.min.css',
    'resources/assets/front/style.css',
    'resources/assets/front/css/animate.css',
    'resources/assets/front/css/responsive.css',
    'resources/assets/front/css/colors.css',
    'resources/assets/front/css/version/marketing.css'
], 'public/assets/front/css/front.css').styles('resources/css/tailwind.output.css', 'public/css/tailwind.css',);

mix.scripts([
    'resources/assets/front/js/jquery.min.js',
    'resources/assets/front/js/tether.min.js',
    'resources/assets/front/js/bootstrap.min.js',
    'resources/assets/front/js/animate.js',
    'resources/assets/front/js/custom.js',
], 'public/assets/front/js/front.js');

mix.copyDirectory('resources/assets/front/fonts', 'public/assets/front/fonts');
mix.copyDirectory('resources/assets/front/images', 'public/assets/front/images');
mix.copyDirectory('resources/assets/front/upload', 'public/assets/front/upload');
