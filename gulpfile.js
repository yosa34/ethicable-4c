const gulp = require('gulp');
const sass = require('gulp-sass');
const sassGlob = require("gulp-sass-glob");

// gulp.task('default', function(done) {
//   // place code for your default task here
//   console.log('gulp start');
//   done();
// });

/*
    コマンド：gulp
*/
gulp.task('sass', function(done){
    // stream
    gulp.src('./html/pages/style/sass/**/*.scss') //タスクで処理するソースの指定
    .pipe(sassGlob()) // Sassの@importにおけるglobを有効にする
    .pipe(sass()) //処理させるモジュールを指定
    .pipe(gulp.dest('./html/pages/style/css/')); //保存先を指定

    console.log('sass compile');
    done();
});

/*
    コマンド：gulp　watch
*/
gulp.task('watch', function(done){
    gulp.watch('./html/pages/style/sass/**/*.scss', gulp.task('sass'));
    //watch task
    console.log('watch start');
    done();
});



gulp.task('default', gulp.task('sass'));