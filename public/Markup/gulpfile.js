const gulp = require('gulp');
const sass = require('gulp-sass');
const gulpif = require('gulp-if');
const autoprefixer = require('gulp-autoprefixer');
const browserSync = require('browser-sync');
const changed = require('gulp-changed');
const nunjucksRender = require('gulp-nunjucks-render');
const include = require('gulp-include');
const uglify = require('gulp-uglify');
var pipeline = require('readable-stream').pipeline;


let envDev = true;

const path = {
    build: {
        html: './build/',
        js: './build/js/',
        css: './build/css/',
        img: './build/img/',
        libs: './build/libs/',
        fonts: './build/fonts/'
    },
    src: {
        html: './src/*.html',
        js: './src/js/*.js',
        style: './src/style/*.scss',
        img: './src/img/**/*.*',
        libs: './src/libs/**/*.*',
        fonts: './src/fonts/**/*.*'
    },
    watch: {
        html: './src/**/*.html',
        js: './src/js/**/*.js',
        style: './src/style/**/*.scss',
        img: './src/img/**/*.*',
        libs: './src/libs/**/*.*',
        fonts: './src/fonts/**/*.*'
    },
    dir: './build'
};

gulp.task('init-sync', function (cb) {
    browserSync({
        open: false,
        notify: false,
        server: {
            baseDir: path.dir
        }
    });
    cb();
});

gulp.task('style:build', function (cb) {
    return gulp.src(path.src.style, {sourcemaps: envDev})
        .pipe(sass().on('error', sass.logError))
        .pipe(gulpif(!envDev, autoprefixer(['> 5% in RU', 'IE >= 10', 'Firefox >= 12', 'Opera >= 12.11'])))
        .pipe(gulp.dest(path.build.css, {sourcemaps: '.'}))
});

gulp.task('style:build:prod', function (cb) {
    return gulp.src(path.src.style, {sourcemaps: envDev})
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(gulpif(!envDev, autoprefixer(['> 5% in RU', 'IE >= 10', 'Firefox >= 12', 'Opera >= 12.11'])))
        .pipe(gulp.dest(path.build.css, {sourcemaps: '.'}))
});

gulp.task('img:build', function (cb) {
    return gulp.src(path.src.img)
        .pipe(changed(path.build.img))
        .pipe(gulp.dest(path.build.img));
});

gulp.task('libs:build', function (cb) {
    return gulp.src(path.src.libs)
        .pipe(changed(path.build.libs))
        .pipe(gulp.dest(path.build.libs));
});

gulp.task('js:build', function (cb) {
    return gulp.src(path.src.js)
        .pipe(include())
        .on('error', console.log)
        .pipe(gulp.dest(path.build.js));
});

gulp.task('js:build:prod', function (cb) {
    return gulp.src('./src/js/**/*.js')
        .pipe(uglify())
        .pipe(gulp.dest(path.build.js))
});

gulp.task('html:build', function (cb) {
    return gulp.src(path.src.html)
        .pipe(include())
        .pipe(gulp.dest(path.build.html))
});


gulp.task('watch', function (cb) {
    gulp.watch(path.watch.style, {usePolling: true}, gulp.series('style:build'));
    gulp.watch(path.watch.html, {usePolling: true}, gulp.series('html:build'));
    gulp.watch(path.watch.img, {usePolling: true}, gulp.series('img:build'));
    gulp.watch(path.watch.libs, {usePolling: true}, gulp.series('libs:build'));
    gulp.watch(path.watch.js, {usePolling: true}, gulp.series('js:build'));
    cb();
});

gulp.task('build', gulp.series('style:build', 'html:build', 'img:build', 'libs:build', 'js:build'));
gulp.task('prod', gulp.series('style:build:prod', 'html:build', 'img:build', 'libs:build', 'js:build:prod'));
gulp.task('default', gulp.series('build', 'watch'));