var gulp = require('gulp'),  
sys = require('sys'),
exec = require('child_process').exec;

gulp.task('phpunit', function() {
    exec('vendor/bin/phpunit', function(error, stdout) {
        sys.puts(stdout); 
    });
}); 

gulp.task('default', function() {
    gulp.watch('tests/**/*.php', { debounceDelay: 2000 }, ['phpunit']);   
});