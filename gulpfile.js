"use strict";
// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var sass = require('gulp-sass')(require('sass'));
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var livereload = require('gulp-livereload');
var minifyCss = require('gulp-cssnano');
var cleanCSS = require('gulp-clean-css');
var rev = require('gulp-rev');
var sourcemaps = require('gulp-sourcemaps');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify-es').default;
var header = require('gulp-header');

var fs = require('fs');
var del = require('del') ;


// Passed color to _variable.scss
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

// Default
var themecolor = '#0065b3';
var colorthemetext = '#ffffff';
var themePropertiesDefault = {
    themeName: 'pink', // main theme
    mainColor: '#0065b3',
    mainTextColor: '#ffffff'
};


function makeCleanCssAssetsFilesThemeStyleDevDf(reset = false) {
    if(reset) {
        del('./assets/css/default.min.css', {force:true});
        del('./assets/css/default.min.css.map', {force:true});
    }
}

function makeCleanCssAssetsFilesThemeStyleDev(reset = false) {
    if(reset) {
        del('./assets/css/style.min.css', {force:true});
        del('./assets/css/style.min.css.map', {force:true});
        del('./assets/css/default.min.css', {force:true});
        del('./assets/css/default.min.css.map', {force:true});
        
        for (let index = 0; index < colorthemes.length; index++) {
            let themeProperties = colorthemes[index];
            del('./assets/css/'+themeProperties.themeName+'.min.css', {force:true});
            del('./assets/css/'+themeProperties.themeName+'.min.css.map', {force:true});
        }
    }
}

/**
 * Build common theme style
 * @param {*} env ['dev', 'build', 'production']
 * @returns 
 */
function buildSassDf(env) {
    let childPath = '';
    if(env === 'build'){
        return (
            gulp.src('./Devs/sass/commons/**/*.scss')
                .pipe(sass())
                .pipe(cleanCSS())
                .pipe(minifyCss())
                .pipe(rename('style.min.css'))
                .pipe(gulp.dest('./assets/css'))
        );

    } else if(env === 'dev'){
        return (
            gulp.src('./Devs/sass/commons/**/*.scss')
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

function buildThemeStyleSassDf(env, themeProperties, defaultStyle = false) {
    let childPath = 'default';
    if(env === 'build'){
        makeCleanCssAssetsFilesThemeStyleDev(true);

        if(defaultStyle) {
            childPath = 'default';
            return (
                gulp.src('./Devs/sass/themeStyles/**/*.scss')
                    .pipe(header('$themeColor: ' + themeProperties.mainColor + ';\n' +
                        '$colorThemeText: ' + themeProperties.mainTextColor + ';\n'))
                    .pipe(sass())
                    .pipe(cleanCSS())
                    .pipe(minifyCss())
                    .pipe(rename(childPath + '.min.css'))
                    .pipe(gulp.dest('./assets/css'))
            );
        } else if(themeProperties && themeProperties !== 'undefined'){
            if(themeProperties.themeName !== 'default') // !default color
            {
                childPath = themeProperties.themeName;
            }
            themecolor = themeProperties.mainColor;
            colorthemetext = themeProperties.mainTextColor;

            return (
                gulp.src('./Devs/sass/themeStyles/**/*.scss')
                    .pipe(header('$themeColor: ' + themecolor + ';\n' +
                        '$colorThemeText: ' + colorthemetext + ';\n'))
                    .pipe(sass())
                    .pipe(cleanCSS())
                    .pipe(minifyCss())
                    .pipe(rename(childPath + '.min.css'))
                    .pipe(gulp.dest('./assets/css'))
            );
        }

    } else if(env === 'dev') {
        childPath = 'default';
        makeCleanCssAssetsFilesThemeStyleDev(false);
        makeCleanCssAssetsFilesThemeStyleDevDf(true);

        if(defaultStyle) {
            childPath = 'default';
            return (
                gulp.src('./Devs/sass/themeStyles/**/*.scss')
                    .pipe(header('$themeColor: ' + themeProperties.mainColor + ';\n' +
                        '$colorThemeText: ' + themeProperties.mainTextColor + ';\n'))
                    .pipe(sourcemaps.init())
                    .pipe(sass())
                    .pipe(cleanCSS())
                    .pipe(minifyCss())
                    .pipe(rename(childPath + '.min.css'))
                    .pipe(sourcemaps.write('.'))
                    .pipe(gulp.dest('./assets/css'))
            );
        } else if(themeProperties && themeProperties !== 'undefined'){
            if(themeProperties.themeName !== 'default') // !default color
            {
                childPath = themeProperties.themeName;
            }
            themecolor = themeProperties.mainColor;
            colorthemetext = themeProperties.mainTextColor;

            return (
                gulp.src('./Devs/sass/themeStyles/**/*.scss')
                    .pipe(header('$themeColor: ' + themecolor + ';\n' +
                        '$colorThemeText: ' + colorthemetext + ';\n'))
                    .pipe(sourcemaps.init())
                    .pipe(sass())
                    .pipe(cleanCSS())
                    .pipe(minifyCss())
                    .pipe(rename(childPath + '.min.css'))
                    .pipe(sourcemaps.write('.'))
                    .pipe(gulp.dest('./assets/css'))
            );
        }
    }
}

function buildSass() { return buildSassDf('dev');}

function buildThemeStyleSass() {
    // for (let index = 0; index < colorthemes.length; index++) {
    //     let themeProperties = colorthemes[index];
    //     buildThemeStyleSassDf('dev', themeProperties);
    // }
    return buildThemeStyleSassDf('dev', themePropertiesDefault, true);
}

function buildSassBuild() {
    return buildSassDf('build');
}

function buildThemeStyleSassBuild() {
    // for (let index = 0; index < colorthemes.length; index++) {
    //     let themeProperties = colorthemes[index];
    //     buildThemeStyleSassDf('build', themeProperties);
    // }
    return buildThemeStyleSassDf('build', themePropertiesDefault, true);
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
    //del('./admin/panel/panel.min.css', {force:true});
    //del('./admin/panel/panel.min.css.map', {force:true});
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
            './Devs/sass/themeStyles/**/*',
            './Devs/sass/commons/**/*',
            './Devs/admins/**/*',
            './Devs/panels/**/*',
            './Devs/js/*.js'
        ],
        gulp.parallel(buildThemeStyleSass, buildSass, buildAdminSass, buildPanelSass, compressCustomThemeJs)
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
        buildThemeStyleSass,
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
        buildThemeStyleSassBuild,
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

//// ===================================================
var pluginPath = '../../plugins/';

var pluginNames = [
    'ws24h-appointment-fast',
    'ws24h-support'
];


// ------------ For dev Plugin ws24hAppointment-----------------------
var pluginName = 'ws24h-appointment-fast';
var pluginCompressName = 'ws24h.plugin.min';
var pluginCompressNameAdmin = 'admin.ws24h.plugin.min';

var delFiles = [
    pluginPath + pluginName + '/assets/js/' + pluginCompressName + '.js',
    pluginPath + pluginName + '/assets/js/' + pluginCompressName + '.css'
];

function makeCleanWs24hPluginJsFiles(){
    if(delFiles && delFiles.length > 0) {
        delFiles.forEach(elm => {
            del(pluginPath + elm, {force:true});
        })
    }
}

function makeCompressWs24hPluginJsFiles(){return makeCompressWs24hPluginJsFilesDf();}
function makeCompressWs24hPluginJsFilesAdmin(){return makeCompressWs24hPluginJsFilesDf('admin');}

function makeCompressWs24hPluginJsFilesDf(mode = null){
    var _mode = '';
    if(mode && mode == 'admin')
    {
        _mode = 'admin/';
        pluginCompressName = pluginCompressNameAdmin;
    }
    // makeCleanWs24hPluginJsFiles();
    return (
        gulp.src(pluginPath + pluginName + '/dev/' + _mode + 'js/*.js')
            .pipe(babel())
            .pipe(concat(pluginCompressName + '.js'))
            .pipe(uglify())
            .pipe(gulp.dest(pluginPath + pluginName+'/assets/js'))
    );
}

function makeCompressWs24hPluginSassFilesDf(mode = null, env, themeProperties, defaultStyle = false) {
    var _mode = '';
    let childPath = pluginCompressName;
    if(mode && mode == 'admin')
    {
        _mode = 'admin/';
        childPath = 'admin.' + childPath;
    }
    return (
        gulp.src(pluginPath + pluginName+'/dev/' + _mode + 'sass/commons/**/*.scss')
            .pipe(sass())
            .pipe(cleanCSS())
            .pipe(minifyCss())
            .pipe(rename(childPath + '.css'))
            .pipe(gulp.dest(pluginPath + pluginName+'/assets/css'))
    );
}

function makeCompressWs24hPluginSassStylesFilesDf(mode = null, env, themeProperties, defaultStyle = false) {
    var _mode = '';
    let childPath = pluginCompressName;
    if(mode && mode == 'admin')
    {
        _mode = 'admin/';
        pluginCompressName = pluginCompressNameAdmin;
    }

    if(defaultStyle) {
        childPath = pluginCompressName;
        return (
            gulp.src(pluginPath + pluginName+'/dev/' + _mode + 'sass/**/*.scss')
                .pipe(header('$themeColor: ' + themeProperties.mainColor + ';\n' +
                    '$colorThemeText: ' + themeProperties.mainTextColor + ';\n'))
                .pipe(sass())
                .pipe(cleanCSS())
                .pipe(minifyCss())
                .pipe(rename(childPath + '.css'))
                .pipe(gulp.dest(pluginPath + pluginName+'/assets/css'))
        );

    } else if(themeProperties && themeProperties !== 'undefined'){
        if(themeProperties.themeName !== 'default') // !default color
        {
            childPath = pluginCompressName + '.' + themeProperties.themeName;
        }
        themecolor = themeProperties.mainColor;
        colorthemetext = themeProperties.mainTextColor;
        return (
            gulp.src(pluginPath + pluginName+'/dev/' + _mode + 'sass/**/*.scss')
                .pipe(header('$themeColor: ' + themecolor + ';\n' +
                    '$colorThemeText: ' + colorthemetext + ';\n'))
                .pipe(sass())
                .pipe(cleanCSS())
                .pipe(minifyCss())
                .pipe(rename(childPath + '.min.css'))
                .pipe(gulp.dest(pluginPath + pluginName+'/assets/css'))
        );
    }
}

function makeWatchTaskPluginFilesDf(){
    gulp.watch(
        [
            pluginPath + pluginName+'/dev/sass/**/*',
            pluginPath + pluginName+'/dev/js/**/*',
            pluginPath + pluginName+'/dev/admin/sass/**/*',
            pluginPath + pluginName+'/dev/admin/js/**/*'
        ],
        gulp.parallel(makeCompressWs24hPluginSassStyleFiles, makeCompressWs24hPluginSassFiles, makeCompressWs24hPluginSassFilesAdmin, makeCompressWs24hPluginJsFiles, makeCompressWs24hPluginJsFilesAdmin)
    );
}

function makeCompressWs24hPluginSassFiles() {
    return makeCompressWs24hPluginSassFilesDf(null, 'dev', themePropertiesDefault, true);
}

function makeCompressWs24hPluginSassStyleFiles() {
    for (let index = 0; index < colorthemes.length; index++) {
        let themeProperties = colorthemes[index];
        makeCompressWs24hPluginSassStylesFilesDf(null, 'dev', themeProperties);
    }
    return makeCompressWs24hPluginSassStylesFilesDf(null, 'dev', themePropertiesDefault, true);
}

function makeCompressWs24hPluginSassFilesAdmin() { return makeCompressWs24hPluginSassFilesDf('admin');}

function makeWatchTaskPluginFiles(){return makeWatchTaskPluginFilesDf();}

gulp.task('plugins', gulp.series(
        makeCompressWs24hPluginSassStyleFiles,
        makeCompressWs24hPluginSassFiles,
        makeCompressWs24hPluginSassFilesAdmin,
        makeCompressWs24hPluginJsFiles,
        makeCompressWs24hPluginJsFilesAdmin,
        makeWatchTaskPluginFiles
    )
);