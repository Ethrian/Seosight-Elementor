/* Created by Sergey on 15.05.2017.*/

/*===========GULP==============*/


var gulp = require('gulp'),
	sass = require('gulp-sass'),
	plumber = require('gulp-plumber'),
	autoprefixer = require('gulp-autoprefixer'),
	runSequence = require('run-sequence');


/*===========Compile SCSS==============*/


gulp.task('sass', function() {

	gulp.src('sass/**/*.scss')
		.pipe(plumber())
		.pipe(sass())
		.pipe(autoprefixer(
			{
				browsers: ['last 12 versions'],
				cascade: false
			}
		))
		.pipe(gulp.dest('css'))
		.pipe(sass({errLogToConsole: true}));
});


/*/!*===========Watch==============*!/*/


gulp.task('watch', ['sass'], function (){

	gulp.watch('sass/**/*.scss', ['sass']);
	// others
});


/*/!*=============Join tasks==============*!/*/


gulp.task('default', function(callback) {
	runSequence(['sass', 'watch'],
		callback
	)
});
