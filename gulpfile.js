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

function buildAdminSass(cb) {
    return (
        gulp.src('./Devs/admins/**/*.scss')
            .pipe(sourcemaps.init())
            .pipe(sass())
            .pipe(minifyCss())
            .pipe(rename('admin.min.css'))
            .pipe(sourcemaps.write('.'))
            .pipe(gulp.dest('./admin/assets'))
            .pipe(livereload())
    );
}

function buildPanelSass(cb) {
    return (
        gulp.src('./Devs/panels/**/*.scss')
            .pipe(sourcemaps.init())
            .pipe(sass())
            .pipe(minifyCss())
            .pipe(rename('panel.min.css'))
            .pipe(sourcemaps.write('.'))
            .pipe(gulp.dest('./panel'))
            .pipe(livereload())
    );
}

function watchTask(){
    gulp.watch(
        ['./Devs/sass/**/*', './Devs/admins/**/*'],
        gulp.parallel(buildSass, buildAdminSass, buildPanelSass)
    );
}
gulp.task('default', gulp.series(buildSass, buildAdminSass, buildPanelSass, watchTask));