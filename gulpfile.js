let gulp = require('gulp'),
        browserSync = require("browser-sync"),
        reload = browserSync.reload,
        rename = require('gulp-rename'),
        sass = require('gulp-sass'),
        cssmin = require('gulp-clean-css'),
        autoprefixer = require('gulp-autoprefixer'),
        sourcemaps = require('gulp-sourcemaps'),
        webpack = require('webpack-stream'),
        named = require('vinyl-named'),
        plumber = require("gulp-plumber");

var path = {
    src: {
            app: "src/app/main.js",
            html: "src/index.html",
            styles: "src/assets/styles/styles.scss"
    },
    build: {
            app: "public/app/",
            html: "app/views/index/",
            css: "public/assets/"
    }
};
var appConfigProd = require('./src/app/webpack.config.prod.js');

gulp.task('app:prod', function () {
    gulp.src(path.src.app)
        .pipe(plumber())
        .pipe(named())
        .pipe(webpack(appConfigProd))
        .pipe(gulp.dest(path.build.app))
        .pipe(reload({stream: true}));
});

gulp.task("html:prod", function () {
	gulp.src(path.src.html)
        .pipe(plumber())
        .pipe(rename({extname: '.phtml'}))
        .pipe(plumber.stop())
	.pipe(gulp.dest(path.build.html))
	.pipe(reload({stream: true}));
});

gulp.task("styles:prod", function () {
    gulp.src(path.src.styles)
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(sass())
        // .pipe(postcss([ flexboxfixer, autoprefixer({ browsers: ["last 2 version", "safari 6.1"] }) ]))
        .pipe(autoprefixer())
        .pipe(cssmin())
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write())
        .pipe(plumber.stop())
        .pipe(gulp.dest(path.build.css))
        .pipe(reload({stream: true}));
});

gulp.task("markup:prod", [
	"styles:prod",
	"app:prod"
]);

gulp.task("prod", [
	"styles:prod",
	"app:prod",
	"html:prod"
]);