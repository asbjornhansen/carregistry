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
mix.setPublicPath('../../../../../../public/');
mix.copy('node_modules/@mdi/font/css/materialdesignicons.css', '../../../../../../public/css/material-icons.min.css');


mix.sass(`${__dirname}/app.scss`, 'css')

mix.js(`${__dirname}/app.js`, 'js')
    .sourceMaps();

