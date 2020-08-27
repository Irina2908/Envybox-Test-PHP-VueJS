let gulp = require('gulp'),
        browserSync = require("browser-sync"),
        reload = browserSync.reload,
        rename = require('gulp-rename'),
        webpack = require('webpack-stream'),
        named = require('vinyl-named'),
        plumber = require("gulp-plumber");

var path = {
    src: {
            app: "src/app/main.js",
            html: "src/index.html",
            assets: ["src/assets/**/*", "!src/assets/**/*.css"], //assets except styles
            styles: "src/assets/**/*.css",
            plugins: "plugins/**/*"
    },
    build: {
            app: "public/app/",
            html: "app/views/index/",
            assets: "public/assets/",
            plugins: "public/plugins/"
    }
};
var appConfigProd = require('/src/app/webpack.config.prod.js');

gulp.task('assets:prod', () => {
    // copy assets (except styles)
    gulp.src(path.src.assets)
        .pipe(gulp.dest(path.build.assets));
    // copy styles
    gulp.src(path.src.styles)
        .pipe(gulp.dest(path.build.assets));
});

gulp.task('plugins:prod', () => {
    // copy plugins
    gulp.src(path.src.plugins)
        .pipe(gulp.dest(path.build.plugins));
});

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
        .pipe(rename({extname: '.phtml'}))
	.pipe(gulp.dest(path.build.html))
	.pipe(reload({stream: true}));
});

gulp.task("prod", [
	"assets:prod",
	"plugins:prod",
	"app:prod",
	"html:prod"
]);