var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    compass = require('gulp-compass'),
    autoprefixer = require('gulp-autoprefixer'),
    cleancss = require('gulp-clean-css'),
    livereload = require('gulp-livereload');

gulp.task('styles', function(){
	gulp.src('./stylesheets/scss/*.scss')
	  .pipe(compass({
	    config_file: './config/config.rb',
      css: 'stylesheets/css',
      sass: 'stylesheets/scss'
	  }))
	  .on('error', function (err) {
			console.error('Error!', err.message);
		})
		.pipe(autoprefixer())
		.pipe(cleancss())
	  .pipe(gulp.dest('stylesheets/css/'))
		.pipe(livereload());
});


gulp.task('default',['styles']);

gulp.task('watch', function() {
	
	livereload.listen();
	
	// Watch .scss files
	gulp.watch('stylesheets/scss/*.scss', ['styles']);
	gulp.watch('stylesheets/scss/**/*.scss', ['styles']);

});