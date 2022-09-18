const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoPrefixer = require('gulp-autoprefixer');

function sassCompiler(){
  return gulp.src('css/scss/*.scss')
  .pipe(sass({outputStyle: 'compressed'}))
  .pipe(autoPrefixer({
    overrideBrowserslist: ['ie >= 8'],
    cascade: false
  }))
  .pipe(gulp.dest('css/'))
}
  
gulp.task('sass', sassCompiler);

function watch(){
  gulp.watch('css/scss/*.scss', sassCompiler)
}

gulp.task('default', watch);