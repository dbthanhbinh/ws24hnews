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

var fs = require('fs');
var del = require('del') ;

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
            .pipe(gulp.dest('./assets/admin'))
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
gulp.task('dev', gulp.series(buildSass, buildAdminSass, buildPanelSass, watchTask));

// -------------------------------------------
function getCurrentDirFolderName(){
    var directory = __dirname.substring(__dirname.lastIndexOf('\\') + 1);
    return directory;
}

function makeTargetFolder() {
    return (
        gulp.src('*.*', {read: false})
            .pipe(gulp.dest('./' + targetDir))
    );
}

function makeCleanTarget() {
    return del(targetDir+'/**/*', {force:true});
}

function makeCleanDevelop() {
    del(targetDir+'/Devs', {force:true});
    del(targetDir+'/node_modules', {force:true});
    del(targetDir+'/.gitignore', {force:true});
    del(targetDir+'/README.md', {force:true});
    del(targetDir+'/package.json', {force:true});
    del(targetDir+'/package-lock.json', {force:true});
    del(targetDir+'/gulpfile.js', {force:true});
}

// Test build
var sourceDir = getCurrentDirFolderName(); //'../product';
var targetDir = '../'+getCurrentDirFolderName()+'_product'; //'../product';

function makeCopyAllFromSource() {
    return (
        gulp.src(['./**/*'])
            .pipe(gulp.dest('./'+targetDir))
    );
}


gulp.task('build', gulp.series(
    makeTargetFolder,
    makeCleanTarget,
    makeCopyAllFromSource,
    makeCleanDevelop
));