const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

/**
 * Compilación de JS
 */
mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/sections/chat.js', 'public/js/chat.js')

/**
 * Compilación de SASS
 */
    .sass('resources/assets/sass/app.scss', 'public/css')

/**
 * Compilación de CSS
 */

    /**
     * Vendor
     */
    .styles([
        'node_modules/sweetalert/dist/sweetalert.css',
        'resources/assets/css/vendor/bootstrap-flatly.css',
        'resources/assets/css/vendor/metisMenu.min.css',
        'resources/assets/css/vendor/morris.css',
        'resources/assets/css/vendor/font-awesome.css'
    ], 'public/css/vendor/vendor.css')

    /**
     * All
     * Estilos que aplican a toda la app.
     */
    .styles('resources/assets/css/all.css', 'public/css/all.css')

    /**
     * Welcome
     * Estilos unicamente aplicables al landing page
     */
    .styles('resources/assets/css/welcome.css', 'public/css/section/welcome.css')

    /**
     * Dashboard
     * Estilos unicamente aplicables al dashboard de usuario
     */
    .styles('resources/assets/css/dashboard.css', 'public/css/section/dashboard.css')

    /**
     * Blog
     */
    .styles([
        'resources/assets/css/vendor/bootstrap-flatly.css',


    ], 'public/css/section/blog.css')

    /**
     * Invoice Pdf
     */
    .styles('resources/assets/css/pdf/invoice.css', 'public/css/pdf/invoice.css');

mix.version();
