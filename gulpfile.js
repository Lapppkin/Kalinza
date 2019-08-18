'use strict';

// nodejs modules
var gulp = require('gulp'), // основной плагин gulp
    sass = require('gulp-sass'), // sass
    sourcemaps = require('gulp-sourcemaps'), // sourcemaps
    rename = require('gulp-rename'), // переименование файлов
    postcss = require('gulp-postcss'), // постпроцессор css
    beautify = require('gulp-cssbeautify'), // бьютифайр
    minify = require('gulp-clean-css'), // минификатор
    gcmq = require('gulp-group-css-media-queries'), // группировка media queries
    cssnext = require('postcss-cssnext'), // postcss autoprefixer и пр.
    spritesmith = require('gulp.spritesmith'), // генератор спрайтов
    terser = require('gulp-terser'), // минификация js
    //imagemin = require('gulp-imagemin'), //минимизация изображений
    prettify = require('gulp-jsbeautifier'), //бьютифайер
    babel = require('gulp-babel'), // babel
    merge = require('merge-stream'); // объединение потоков

var svgSprite = require('gulp-svg-sprite'),
    svgmin = require('gulp-svgmin'),
    cheerio = require('gulp-cheerio'),
    replace = require('gulp-replace');

var processors = [
    cssnext
];

var templatePath = 'local/templates/kalinzaru/';
var sourcesPath = templatePath + '_src/';

var path = {

    // build paths
    build: {
        js: templatePath + 'js',
        jsVendor: templatePath + 'js/vendor',
        css: templatePath + 'css',
        sprite: templatePath + 'images',
        svg: templatePath + 'images',
    },

    // sources
    src: {
        js: sourcesPath + 'js/[^_]*.js',
        jsVendor: {
            jQuery: 'node_modules/jquery/dist/jquery.min.*',
            bootstrap: 'node_modules/bootstrap/dist/js/bootstrap.bundle.min.*',
            owlCarousel: 'node_modules/owl.carousel/dist/owl.carousel.min.js',
            smoothScroll: 'node_modules/smooth-scroll/dist/smooth-scroll.polyfills.min.js',
            rangeSlider: 'node_modules/ion-rangeslider/js/ion.rangeSlider.min.js',
            sticky: 'node_modules/sticky-block/src/js/jquery.sticky-block.js',
            cookie: 'node_modules/jquery.cookie/jquery.cookie.js',
            fancybox: 'node_modules/@fancyapps/fancybox/dist/jquery.fancybox.min.js',
            ncsColor: sourcesPath + 'js/vendor/w3color.js',
            inputmask: 'node_modules/inputmask/dist/min/jquery.inputmask.bundle.min.js',
            pageScrollToId: 'node_modules/page-scroll-to-id/jquery.malihu.PageScroll2id.js',
            blazy: 'node_modules/blazy/blazy.min.js'
        },
        css: sourcesPath + 'css/[^_]*.scss',
        cssSprites: sourcesPath + 'css/init',
        sprite: sourcesPath + 'images/sprites/*.png',
        svg: sourcesPath + 'svg/*.svg',
        svgTemplate: sourcesPath + 'svg/_template.scss',
        mustache: sourcesPath + 'images/sprites/_leather.mustache'
    },

    // watch files
    watch: {
        js: sourcesPath + 'js/*.js',
        css: [
            sourcesPath + 'css/blocks/*.scss',
            sourcesPath + 'css/bootstrap/*.scss',
            sourcesPath + 'css/common/*.scss',
            sourcesPath + 'css/init/*.scss',
            sourcesPath + 'css/vendor/*.scss',
            sourcesPath + 'css/*.scss',
        ],
        sprite: sourcesPath + 'images/sprites/*.png',
        svg: sourcesPath + 'svg/**/*.svg',
    }
};


// css
function cssBuild() {
    return gulp.src(path.src.css).
        pipe(sourcemaps.init()).
        pipe(sass({
            'compress': false,
            'include css': true
        })).
        pipe(postcss(processors)).
        pipe(gcmq()).
        //pipe(beautify()).
        pipe(rename({
            basename: 'styles',
            extname: '.css'
        })).
        pipe(minify()).
        pipe(sourcemaps.write('.')).
        pipe(gulp.dest(path.build.css));
}

// sprites (PNG)
function spriteBuild() {

    gulp.src(path.src.svg).
        //pipe(svg2png()).
        pipe(gulp.dest(path.src.sprite));

    var spriteData =
        gulp.src(path.src.sprite).
            pipe(spritesmith({
                imgName: 'sprites.png',
                cssName: '_png_sprites.scss',
                cssFormat: 'scss',
                //algorithm: 'binary-tree',
                //padding: 1,
                cssTemplate: path.src.mustache,
                cssVarMap: function (sprite) {
                    sprite.name = 'leather-i-' + sprite.name;
                }
            }));
    var imgStream = spriteData.img.
        pipe(gulp.dest(path.build.sprite)); // путь, куда сохраняем картинку
    var cssStream = spriteData.css.
        pipe(gulp.dest(path.src.cssSprites));
    return merge(imgStream, cssStream);
}

// sprites (SVG)
function svgBuild() {
    return gulp.src(path.src.svg).
        // minify svg
        pipe(svgmin({
            js2svg: {
                pretty: true
            }
        })).
        // remove all fill, style and stroke declarations in out shapes
        pipe(cheerio({
            run: function ($) {
                $('[fill]').removeAttr('fill');
                $('[stroke]').removeAttr('stroke');
                $('[style]').removeAttr('style');
                $('style').remove();
            },
            parserOptions: {xmlMode: true}
        })).
        // cheerio plugin create unnecessary string '&gt;', so replace it
        pipe(replace('&gt;', '>')).
        // build svg sprite
        pipe(svgSprite({
            mode: {
                symbol: {
                    sprite: 'sprites.svg',
                    render: {
                        scss: {
                            dest: __dirname + '/../_src/css/init/_svg_sprites.scss',
                            template: path.src.svgTemplate
                        }
                    }
                }
            }
        })).
        pipe(gulp.dest(path.build.svg));
}

// vendor js
function jsVendorBuild() {
    return gulp.src([
        path.src.jsVendor.jQuery,
        path.src.jsVendor.bootstrap,
        path.src.jsVendor.owlCarousel,
        //path.src.jsVendor.rangeSlider,
        //path.src.jsVendor.sticky,
        //path.src.jsVendor.cookie,
        path.src.jsVendor.fancybox,
        //path.src.jsVendor.ncsColor,
        path.src.jsVendor.inputmask,
        path.src.jsVendor.pageScrollToId,
        //path.src.jsVendor.blazy,
    ]).
        pipe(gulp.dest(path.build.jsVendor));
}

// custom js
function jsBuild() {
    return gulp.src(path.src.js).
        pipe(babel({
            presets: ['env']
        })).
        pipe(terser({
            mangle: false,
            compress: false,
        })).
        pipe(rename({
            suffix: '.min'
        })).
        pipe(gulp.dest(path.build.js));
}


// tasks
gulp.task('css:build', cssBuild);
gulp.task('sprite:build', spriteBuild);
gulp.task('svg:build', svgBuild);
gulp.task('jsVendor:build', jsVendorBuild);
gulp.task('js:build', jsBuild);

// watch
function watch() {
    gulp.watch(path.watch.css, gulp.series('css:build'));
    gulp.watch(path.watch.js, gulp.series('js:build'));
    gulp.watch(path.watch.svg, gulp.series('svg:build'));
    gulp.watch(path.watch.sprite, gulp.series('sprite:build'));
}

gulp.task('watch', watch);

// build task
gulp.task('build', gulp.series(
    'sprite:build',
    'css:build',
    'js:build',
    'jsVendor:build',
    'svg:build'
));

// default task
gulp.task('default', gulp.parallel('build', 'watch'));
