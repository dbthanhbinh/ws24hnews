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
var header = require('gulp-header');

var fs = require('fs');
var del = require('del') ;

function makeCleanCssFile() {
    del('./assets/css/style.min.css', {force:true});
    del('./assets/css/style.min.css.map', {force:true});
}

// passed color to _variable.scss
var colorthemes = [];
    colorthemes.push({
        themeName: 'pink', // main theme
        mainColor: '#e83e8c',
        mainTextColor: '#ffffff'
    });

    colorthemes.push({
        themeName: 'green', // main theme
        mainColor: '#24ca24',
        mainTextColor: '#ffffff'
    });
    colorthemes.push({
        themeName: 'nail', // main theme
        mainColor: '#8c1236',
        mainTextColor: '#ffffff'
    });
    colorthemes.push({
        themeName: 'red', // main theme
        mainColor: '#dc3545',
        mainTextColor: '#ffffff'
    });

    var themecolor = '#0065b3';
    var colorthemetext = '#ffffff';

function buildSassDf(env, themeProperties) {
    if(env === 'build'){
        makeCleanCssFile();
        if(themeProperties && themeProperties !== 'undefined'){
            let childPath = '';
            if(themeProperties.themeName !== 'pink') // default color
            {
                childPath = '/' + themeProperties.themeName;
                gulp.src('*.*', {read: false})
                    .pipe(gulp.dest('./assets/css'+childPath))
            }
            return (
                gulp.src('./Devs/sass/**/*.scss')
                    .pipe(header('$themeColor: ' + themeProperties.mainColor + ';\n' +
                        '$colorThemeText: ' + themeProperties.mainTextColor + ';\n'))
                    .pipe(sass())
                    .pipe(cleanCSS())
                    .pipe(minifyCss())
                    .pipe(rename('style.min.css'))
                    .pipe(gulp.dest('./assets/css'+childPath))
            );
        } else {
            return (
                gulp.src('./Devs/sass/**/*.scss')
                    .pipe(header('$themeColor: ' + themecolor + ';\n' +
                        '$colorThemeText: ' + colorthemetext + ';\n'))
                    .pipe(sass())
                    .pipe(cleanCSS())
                    .pipe(minifyCss())
                    .pipe(rename('style.min.css'))
                    .pipe(gulp.dest('./assets/css'))
            );
        }
    } else {
        return (
            gulp.src('./Devs/sass/**/*.scss')
                .pipe(header('$themeColor: ' + themecolor + ';\n' +
                    '$colorThemeText: ' + colorthemetext + ';\n'))
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

function buildSassBuild() {
    for (let index = 0; index < colorthemes.length; index++) {
        let themeProperties = colorthemes[index];
        buildSassDf('build', themeProperties);
    }
    // buildSassDf('build');
}

function makeCleanAdminFile() {
    del('./admin/assets/admin.min.css', {force:true});
    del('./admin/assets/admin.min.css.map', {force:true});
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
                .pipe(gulp.dest('./admin/assets'))
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
                .pipe(gulp.dest('./admin/assets'))
                .pipe(livereload())
        );
    }
}

function buildAdminSass() { return buildAdminSassDf('dev') }
function buildAdminSassBuild() { return buildAdminSassDf('build') }


function makeCleanPanelFile() {
    del('./admin/panel/panel.min.css', {force:true});
    del('./admin/panel/panel.min.css.map', {force:true});
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
                .pipe(gulp.dest('./admin/panel'))
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
                .pipe(gulp.dest('./admin/panel'))
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
        ],
        gulp.parallel(buildSass, buildAdminSass, buildPanelSass)
    );
}

// ============ Build for javascript =============================
function makeCleanJsFile() {
    del('./assets/js/themejs.min.js', {force:true});
}
function makeCleanTickyJsFile() {
    del('./assets/js/sticky_sidebar.min.js', {force:true});
}
function compressCustomThemeJs(cb) {
    makeCleanJsFile();
    return (
        gulp.src('./Devs/js/*.js')
            .pipe(babel())
            .pipe(concat('themejs.min.js'))
            .pipe(uglify())
            .pipe(gulp.dest('./assets/js'))
    );
}

function compressTickySidebarJs(cb) {
    makeCleanTickyJsFile();
    return (
        gulp.src('./Devs/tickyjs/*.js')
            .pipe(babel())
            .pipe(concat('sticky_sidebar.min.js'))
            .pipe(uglify())
            .pipe(gulp.dest('./assets/js'))
    );
}

////// ------------ For dev features -----------------------
gulp.task('dev', gulp.series(
        buildSass,
        buildAdminSass,
        buildPanelSass,
        buildBootstrapSass,
        compressCustomThemeJs,
        compressTickySidebarJs,
        watchTask
    )
);
// End Dev

////// ------------ For build product Demo -----------------------
gulp.task('build', gulp.series(
        buildSassBuild,
        buildAdminSassBuild,
        buildPanelSassBuild,
        buildBootstrapSassBuild,
        compressCustomThemeJs,
        compressTickySidebarJs
    )
);

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
    return del(targetDir+'/gulpfile.js', {force:true});
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

////// ------------ For build product Download ws24h -----------------------
gulp.task('product', gulp.series(
    makeTargetFolder,
    makeCleanTarget,
    makeCopyAllFromSource,
    makeCleanDevelop
));