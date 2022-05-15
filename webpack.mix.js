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

mix.js('resources/js/app.js', 'public/js').vue({version: 3})
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .alias({
        '@' : 'resources/js',
    })
    .webpackConfig(require('./webpack.config'))
    .setPublicPath('public');

if (mix.inProduction()) {
    mix.version();
} else {
    mix.browserSync({
        proxy: 'localhost',
        open: false,
    });
}

mix.disableSuccessNotifications();
