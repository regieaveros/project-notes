const mix = require('laravel-mix');

mix.js("resources/js/app.js", "public/js")
  .js("resources/js/alpine.js", "public/js/alpine.js")
  .js("./node_modules/axios/dist/axios.min.js", "public/js/axios.js")
  .sass('resources/css/style.scss', 'public/css/style.css')
  .postCss("resources/css/app.css", "public/css", [
    require("tailwindcss"),
]);