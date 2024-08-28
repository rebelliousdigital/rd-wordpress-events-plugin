const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const cleanCSS = require('gulp-clean-css');
const rename = require('gulp-rename');
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');
const concat = require('gulp-concat');

// Compile SASS to CSS and minify
gulp.task('sass', function() {
    return gulp.src('assets/sass/**/*.scss')  // Source folder containing the Sass files
        .pipe(sourcemaps.init())              // Initialize sourcemaps
        .pipe(sass().on('error', sass.logError))  // Compile Sass to CSS and log errors
        .pipe(cleanCSS())                     // Minify the compiled CSS
        .pipe(rename({suffix: '.min'}))       // Rename the output file to include .min suffix
        .pipe(sourcemaps.write('.'))          // Write the sourcemaps file in the same folder
        .pipe(gulp.dest('assets/build/css'));       // Destination folder for the compiled CSS files
});

// Process and minify JavaScript
gulp.task('scripts', function() {
    return gulp.src('assets/js/**/*.js')  // Source folder containing the JS files
        .pipe(sourcemaps.init())          // Initialize sourcemaps
        //.pipe(concat('script.min.js'))       // Concatenate all JS files into one (optional)
        .pipe(uglify())                   // Minify the JavaScript
        .pipe(rename({suffix: '.min'}))       // Rename the output file to include .min suffix
        .pipe(sourcemaps.write('.'))      // Write the sourcemaps file in the same folder
        .pipe(gulp.dest('assets/build/js'));    // Destination folder for the compiled JS files
});

// Watch files for changes
gulp.task('watch', function() {
    gulp.watch('assets/sass/**/*.scss', gulp.series('sass'));  // Watch all .scss files in the assets/sass directory
    gulp.watch('assets/js/**/*.js', gulp.series('scripts'));   // Watch all .js files in the assets/js directory
});

// Default task
gulp.task('default', gulp.series('sass', 'scripts', 'watch'));  // Run the sass, scripts, and watch tasks by default