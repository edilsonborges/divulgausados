module.exports = function(grunt) {
    require('load-grunt-tasks')(grunt);
    grunt.initConfig({
	pkg: grunt.file.readJSON('package.json'),
	bower: {
	    install: {
		options: {
		    targetDir: './public/vendor',
		    cleanTargetDir: true,
		    bowerOptions: {
			production: false
		    }
		}
	    }
	},
        jshint: {
            files: ['Gruntfile.js', 'public/app/**/*.js']
        }
    });
    grunt.registerTask('default', ['bower', 'jshint']);
};
