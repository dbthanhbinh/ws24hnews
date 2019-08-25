"use strict";
// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var livereload = require('gulp-livereload');
var minifyCss = require('gulp-cssnano');
var cleanCss = require('gulp-clean-css');
var rev = require('gulp-rev');
var sourcemaps = require('gulp-sourcemaps');

function buildSass(cb) {
    return (
        gulp.src('./Devs/sass/**/*.scss')
            .pipe(sourcemaps.init())
            .pipe(sass())
            .pipe(minifyCss())
            .pipe(rename('style.min.css'))
            .pipe(sourcemaps.write('.'))
            .pipe(gulp.dest('./assets/css'))
            .pipe(livereload())
    );
}

function watchTask(){
    gulp.watch(
        ['./Devs/sass/**/*'],
        gulp.parallel(buildSass)
    );
}
gulp.task('default', gulp.series(buildSass, watchTask));