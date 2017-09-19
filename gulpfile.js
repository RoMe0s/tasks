var gulp = require('gulp');
var uglify = require('gulp-uglify');
var cleanCSS = require('gulp-clean-css');
var concat = require('gulp-concat');

gulp.task('js', function () {
    return gulp.src('./resources/assets/js/**/*.js')
        .pipe(uglify())
        .pipe(gulp.dest('./public/js'));
});

gulp.task('custom_js', function(){
    return gulp.src('./resources/assets/cjs/**/*.js')
        .pipe(concat('custom_app.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./public/js'));
});

gulp.task('css', function () {
    return gulp.src('./resources/assets/css/**/*.css')
        .pipe(cleanCSS())
        .pipe(gulp.dest('./public/css'));
});

gulp.task('fonts', function() {
    return gulp.src('./resources/assets/font/**/*')
        .pipe(gulp.dest('./public/font'));
});

gulp.task('images', function(){
    return gulp.src('./resources/assets/images/**/*')
        .pipe(gulp.dest('./public/images'));
});

gulp.task('default', ['js', 'css', 'fonts', 'images', 'custom_js']);

gulp.task('watch', ['js', 'css', 'fonts', 'images', 'custom_js']);