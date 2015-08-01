module.exports = function(grunt) {
	require('load-grunt-tasks')(grunt);

	grunt.loadNpmTasks('grunt-wiredep');

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		jshint: {
			files: ['Gruntfile.js', 'public/app/**/*.js']
		},
		wiredep: {
			target: {
				src: 'app/views/layout.php',
				ignorePath: '../../public/'
			}
		}
	});

	grunt.registerTask('default', ['jshint', 'wiredep']);
};
