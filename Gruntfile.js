module.exports = function(grunt) {
	require('load-grunt-tasks')(grunt);
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		jshint: {
			files: ['Gruntfile.js', 'public/app/**/*.js']
		}
	});
	grunt.registerTask('default', ['jshint']);
};
