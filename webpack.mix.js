const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');

const stisla = 'public/assets/stisla'
mix.js('./resources/js/stisla.js', `${stisla}/js/app.js`).vue()
    .sass('./resources/sass/stisla/components.scss', `${stisla}/css`)
    .sass('./resources/sass/stisla/style.scss', `${stisla}/css`)