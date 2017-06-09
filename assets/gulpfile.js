// dependencies
var gulp = require('gulp'),
	sass = require('gulp-sass'),
	browserSync = require('browser-sync').create(),
	concatCss = require('gulp-concat-css'),
	cssmin = require('gulp-cssmin'),
	rename = require('gulp-rename');

gulp.task('browserSync', function() {
  browserSync.init({
    server: {
      baseDir: ''
    },
  })
})

gulp.task('scss_dev', function(){
  gulp.src('src/scss/**/*.scss')
    .pipe(sass.sync({outputStyle: 'expanded'})) // Using gulp-sass
    .pipe(gulp.dest('dist/css'))
});

gulp.task('watch', ['scss_dev', 'min'], function(){
  gulp.watch('src/scss/**/*.scss', ['scss_dev']); 
  // Other watchers
})

gulp.task('min', function(){
	gulp.src('dist/css/main.css')
        .pipe(cssmin())
        .pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest('dist/css'))
})

// gulp
gulp.task('default', ['scss_dev', 'min', 'watch']);