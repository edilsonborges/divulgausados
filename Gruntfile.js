module.exports = function(grunt) {

	// Load grunt tasks automatically
	require('load-grunt-tasks')(grunt);

	// Time how long tasks take. Can help when optimizing build times
	require('time-grunt')(grunt);

	// Define the configuration for all the tasks
	grunt.initConfig({
		
		pkg : grunt.file.readJSON('package.json'),
		
		bower: grunt.file.readJSON('bower.json'),
		
		concat : {
			options : {
				separator : ';'
			},
			dist : {
				src : [ 'public/app/**/*.js' ],
				dest : 'public/app/scripts/<%= pkg.name %>.js'
			}
		},
		
		uglify : {
			options : {
				banner : '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
			},

			dist : {
				files : {
					'public/app/scripts/<%= pkg.name %>.min.js' : [ '<%= concat.dist.dest %>' ]
				}
			}
		},

		qunit : {
			files : [ 'app/tests/js/**/*.html' ]
		},

		jshint : {
			files : [ 'Gruntfile.js', 'public/app/**/*.js', 'app/tests/**/*.js', '!public/app/scripts/*.js' ],
			options : {
				// Options here to override JSHint defaults
				globals : {
					jQuery : true,
					console : true,
					module : true,
					document : true
				}
			}
		},

		watch : {
			files : [ '<%= jshint.files %>' ],
			tasks : [ 'jshint', 'qunit' ]
		}
	});

	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-qunit');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-concat');

	grunt.registerTask('test', [ 'jshint', 'qunit' ]);

	grunt.registerTask('default', [ 'jshint', 'qunit', 'concat', 'uglify' ]);

};
