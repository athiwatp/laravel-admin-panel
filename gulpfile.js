var elixir = require('laravel-elixir');

elixir(function (mix) {

    var npmDir = 'node_modules/',
        jsDir = 'resources/assets/js';

    mix.copy(npmDir + 'vue/dist/vue.min.js', jsDir);
    mix.copy(npmDir + 'vue-resource/dist/vue-resource.min.js', jsDir);

    mix.scripts([
        'vue.min.js',
        'vue-resource.min.js'
    ], 'public/js/vendor.js');

    mix.sass('app.scss').version("css/app.css");

    mix.browserSync({proxy: 'localhost:8000'});

});
