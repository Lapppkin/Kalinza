'use strict';

const gulp       = require('gulp'),
      sass       = require('gulp-sass'),
      csso       = require('gulp-csso'),
      sourcemaps = require('gulp-sourcemaps');

gulp.task('scss', () => {
    return gulp.src('local/**/*.scss', {dot: true})
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(csso({restructure: false}))
        .pipe(sourcemaps.write('.', {sourceRoot: '/'}))
        .pipe(gulp.dest('local'));
});

gulp.task('scss:watch', gulp.series('scss', () => {
    gulp.watch([
        'local/**/*.scss',
        'local/**/.default/**/*.scss',
        'local/**/.default/**/.default/**/*.scss'
    ], gulp.series('scss'));
}));

gulp.task('default', gulp.series('scss:watch'));
