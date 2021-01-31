"use strict";
// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var livereload = require('gulp-livereload');
var minifyCss = require('gulp-cssnano');
var cleanCSS = require('gulp-clean-css');
var rev = require('gulp-rev');
var sourcemaps = require('gulp-sourcemaps');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');

var fs = require('fs');
var del = require('del') ;

function makeCleanCssFile() {
    del('./assets/css/style.min.css', {force:true});
    del('./assets/css/style.min.css.map', {force:true});
}
function buildSassDf(env) {
    if(env === 'build'){
        makeCleanCssFile();
        return (
            gulp.src('./Devs/sass/**/*.scss')
                .pipe(sass())
                .pipe(cleanCSS())
                .pipe(minifyCss())
                .pipe(rename('style.min.css'))
                .pipe(gulp.dest('./assets/css'))
        ); 
    } else {
        return (
            gulp.src('./Devs/sass/**/*.scss')
                .pipe(sourcemaps.init())
                .pipe(sass())
                .pipe(cleanCSS())
                .pipe(minifyCss())
                .pipe(rename('style.min.css'))
                .pipe(sourcemaps.write('.'))
                .pipe(gulp.dest('./assets/css'))
                .pipe(livereload())
        );
    }
}

function buildSass() { return buildSassDf('env');}
function buildSassBuild() { return buildSassDf('build'); }


function makeCleanAdminFile() {
    del('./assets/admin/admin.min.css', {force:true});
    del('./assets/admin/admin.min.css.map', {force:true});
}
function buildAdminSassDf(env) {
    if(env === 'build'){
        makeCleanAdminFile();
        return (
            gulp.src('./Devs/admins/**/*.scss')
                .pipe(sass())
                .pipe(cleanCSS())
                .pipe(minifyCss())
                .pipe(rename('admin.min.css'))
                .pipe(gulp.dest('./assets/admin'))
        );
    } else {
        return (
            gulp.src('./Devs/admins/**/*.scss')
                .pipe(sourcemaps.init())
                .pipe(sass())
                .pipe(cleanCSS())
                .pipe(minifyCss())
                .pipe(rename('admin.min.css'))
                .pipe(sourcemaps.write('.'))
                .pipe(gulp.dest('./assets/admin'))
                .pipe(livereload())
        );
    }
}

function buildAdminSass() { return buildAdminSassDf('dev') }
function buildAdminSassBuild() { return buildAdminSassDf('build') }


function makeCleanPanelFile() {
    del('./panel/panel.min.css', {force:true});
    del('./panel/panel.min.css.map', {force:true});
}
function buildPanelSassDf(env) {
    if(env === 'build'){
        makeCleanPanelFile();
        return (
            gulp.src('./Devs/panels/scss/**/*.scss')
                .pipe(sass())
                .pipe(cleanCSS())
                .pipe(minifyCss())
                .pipe(rename('panel.min.css'))
                .pipe(gulp.dest('./panel'))
        );
    } else {
        return (
            gulp.src('./Devs/panels/scss/**/*.scss')
                .pipe(sourcemaps.init())
                .pipe(sass())
                .pipe(cleanCSS())
                .pipe(minifyCss())
                .pipe(rename('panel.min.css'))
                .pipe(sourcemaps.write('.'))
                .pipe(gulp.dest('./panel'))
                .pipe(livereload())
        );
    }
}
function buildPanelSass() { return buildPanelSassDf('dev') }
function buildPanelSassBuild() { return buildPanelSassDf('build') }

// Bootstrap
function makeCleanBoostrapFile() {
    del('./assets/vendor/bootstrap/css/bootstrap.min.css', {force:true});
    del('./assets/vendor/bootstrap/css/bootstrap.min.css.map', {force:true});
}
function buildBootstrapSassDf(env) {
    if(env === 'build'){
        makeCleanBoostrapFile();
        return (
            gulp.src('./Devs/bootstrap/css/**/*.css')
                .pipe(sass())
                .pipe(cleanCSS())
                .pipe(minifyCss())
                .pipe(rename('bootstrap.min.css'))
                .pipe(gulp.dest('./assets/vendor/bootstrap/css'))
        );
    } else {
        return (
            gulp.src('./Devs/bootstrap/css/**/*.css')
                .pipe(sourcemaps.init())
                .pipe(sass())
                .pipe(cleanCSS())
                .pipe(minifyCss())
                .pipe(rename('bootstrap.min.css'))
                .pipe(sourcemaps.write('.'))
                .pipe(gulp.dest('./assets/vendor/bootstrap/css'))
                .pipe(livereload())
        );
    }
}
function buildBootstrapSass() { return buildBootstrapSassDf('dev') }
function buildBootstrapSassBuild() { return buildBootstrapSassDf('build') }

// ===================================================================
function watchTask(){
    gulp.watch(
        [
            './Devs/sass/**/*',
            './Devs/admins/**/*',
            './Devs/panels/**/*',
            './Devs/panels/js/**/*'
        ],
        gulp.parallel(buildSass, buildAdminSass, buildPanelSass)
    );
}

// ============ Build for javascript =============================
function compressPanelJs(cb) {
    return (
        gulp.src('./Devs/panels/js/**/*.js')
            .pipe(babel())
            .pipe(concat('panel.min.js'))
            .pipe(uglify())
            .pipe(gulp.dest('./panel/js'))

    );
}



// ------------ For dev features -----------------------
gulp.task('dev', gulp.series(buildSass, buildAdminSass, buildPanelSass, buildBootstrapSass, watchTask));
// End Dev

// ------------ For build product -----------------------
gulp.task('build', gulp.series(buildSassBuild, buildAdminSassBuild, buildPanelSassBuild, buildBootstrapSassBuild));


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

// Test product
var sourceDir = getCurrentDirFolderName(); //'../product';
var targetDir = '../'+getCurrentDirFolderName()+'_product'; //'../product';

function makeCopyAllFromSource() {
    return (
        gulp.src(['./**/*'])
            .pipe(gulp.dest('./'+targetDir))
    );
}
gulp.task('product', gulp.series(
    makeTargetFolder,
    makeCleanTarget,
    makeCopyAllFromSource,
    makeCleanDevelop
));