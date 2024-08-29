const mix = require('laravel-mix');
require('laravel-mix-flowbite');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .options({
        postCss: [
            require('tailwindcss'),
        ],
    })
    .flowbite();