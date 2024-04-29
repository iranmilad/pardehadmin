// webpack.mix.js

let mix = require('laravel-mix');

mix.sass('resources/sass/style.scss', './resources/css/style-rtl.css', {} , [
    require('rtlcss')()
])