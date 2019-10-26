"use strict";

const { src, dest, watch, series, parallel } = require("gulp");
const concat = require("gulp-concat");
const uglify = require("gulp-uglify-es").default;
/* const browserSync = require("browser-sync").create(); */
const sass = require("gulp-sass");
sass.compiler = require("node-sass");
const sourcemaps = require("gulp-sourcemaps");
const babel = require("gulp-babel");


//Sökvägar
const files = {
    jsPath: "src/javascript/*.js",
    scssPath: "src/scss/*.scss",
}

//Task: Kopiera, sammanslå och minifiera js-filer
function jsTask() {
    return src(files.jsPath)
        .pipe(sourcemaps.init())
        .pipe(babel())
        .pipe(concat("main.js"))
        .pipe(uglify())
        .pipe(sourcemaps.write("."))
        .pipe(dest("pub/js"))
        /* .pipe(browserSync.stream()) */
}

//Task: Kopiera och konvertera SCSS-filer till en CSS-fil och minifiera CSS-filen
function scssTask() {
    return src(files.scssPath)
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: "compressed"}).on("error", sass.logError))
        .pipe(sourcemaps.write("./"))
        .pipe(dest("pub/css"))
        /* .pipe(browserSync.stream()) */
}

//Task: Watcher
function watchTask() {
    /* browserSync.init({
        server: {
            baseDir: 'pub/'
        }
    }); */

    watch([files.jsPath, files.scssPath], 
        parallel(
            jsTask, 
            scssTask),
    )
}

exports.default = series(
    parallel(
        jsTask, 
        scssTask),
    watchTask,
);