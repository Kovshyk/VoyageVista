

const gulp = require('gulp'),
    sass = require('gulp-sass')(require('sass')),
    sourcemaps = require('gulp-sourcemaps'),
    cssmin = require('gulp-cssmin');

gulp.task('sass', function () {
    return gulp.src('frontend/scss/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(sourcemaps.write())
        // .pipe(cssmin())
        .pipe(gulp.dest('frontend/css'));
});

gulp.task('watch', function () {
    gulp.watch('frontend/scss/**/*.scss', gulp.series('sass'));
});
