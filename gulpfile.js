var gulp = require('gulp');
var gulpif = require('gulp-if');
var uglify = require('gulp-uglify');
var uglifycss = require('gulp-uglifycss');
var less = require('gulp-less');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var livereload = require('gulp-livereload');
var env = process.env.GULP_ENV;

//JAVASCRIPT TASK: write one minified js file out of jquery.js, bootstrap.js and all of my custom js files
gulp.task('js', function () {
    var vendorsFiles = [
        'bower_components/jquery/dist/jquery.min.js',
        'bower_components/bootstrap/dist/js/bootstrap.min.js',
        'bower_components/metisMenu/dist/metisMenu.min.js',
        'bower_components/datatables/media/js/jquery.dataTables.min.js',
        'bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js',
        'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'
    ];
    var appFiles = [
        'app/Resources/public/js/**/*.js',
        'src/**/public/js/**/*.js'
    ];
    var files = vendorsFiles.concat(appFiles);

    return gulp.src(files)
        .pipe(concat('javascript.js'))
        .pipe(gulpif(env === 'prod', uglify()))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('web/js'));
});

//CSS TASK: write one minified css file out of bootstrap.less and all of my custom less files
gulp.task('css', function () {
    var vendorsFiles = [
        'bower_components/bootstrap/dist/css/bootstrap.min.css',
        'bower_components/metisMenu/dist/metisMenu.min.css',
        'bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css',
        'bower_components/datatables-responsive/css/dataTables.responsive.css',
        'bower_components/startbootstrap-sb-admin-2/dist/css/sb-admin-2.css',
        'bower_components/font-awesome/css/font-awesome.min.css',
        'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css'
    ];
    var appFiles = [
        'app/Resources/public/less/**/*.less',
        'src/**/public/less/**/*.less'
    ];
    var files = vendorsFiles.concat(appFiles);

    return gulp.src(files)
        .pipe(gulpif(/[.]less/, less()))
        .pipe(concat('styles.css'))
        .pipe(gulpif(env === 'prod', uglifycss()))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('web/css'));
});

//IMAGE TASK: Just pipe images from project folder to public web folder
gulp.task('img', function () {
    var vendorsFiles = [
        'bower_components/**/*.png',
        'bower_components/**/*.jpg'
    ];
    var appFiles = [
        'app/Resources/public/images/*',
        'src/**/public/images/*'
    ];
    var files = vendorsFiles.concat(appFiles);
    return gulp.src(files)
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('web/images'));
});

gulp.task('fonts', function () {
    var vendorsFiles = [
        'bower_components/**/*.otf',
        'bower_components/**/*.eot',
        'bower_components/**/*.svg',
        'bower_components/**/*.ttf',
        'bower_components/**/*.woff',
        'bower_components/**/*.woff2'
    ];
    var appFiles = [
        'app/Resources/public/fonts/*',
        'src/**/public/fonts/*'
    ];
    var files = vendorsFiles.concat(appFiles);
    gulp.src(files)
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('web/fonts'));

    // Special treatment for font-awesome
    return gulp.src('bower_components/font-awesome/fonts/**.*')
        .pipe(gulp.dest('./web/fonts')); 
});

gulp.task('watch', function () {
    livereload.listen();
    return gulp.watch('src/AppBundle/Resources/public/less/*.less', ['css']);
});

//define executable tasks when running "gulp" command
gulp.task('default', ['js', 'css', 'fonts', 'img', 'watch']);
gulp.task('build', ['js', 'css', 'fonts', 'img']);
