
module.exports = function (grunt) {

	'use strict';

	grunt.initConfig({
		pkg: '<json:package.json>',

		watch: {
			app_sass: {
				files: [
				'app/assets/scss/**/*.scss',
				'bower_components/sass-bootstrap/lib/**/*.scss'
				],
				tasks: ['sass:app']
			},

			uglify: {
				files: [
				'app/assets/javascripts/*.js'
				],
				tasks: ['uglify:app']
			},

			imagemin: {

				options: {
					optimizationLevel: 3,
					flatten: false
				},

				files: [
				'app/assets/images/**/*.{png,jpg,jpeg,gif}'
				],
				tasks: ['imagemin']
			}
		},

		sass: {
			options: {
				style: 'compressed'
			},
			app: {
				files: {
					'public/css/style.min.css': 'app/assets/scss/application.scss'
				}
			}
		},

		uglify: {
			app: {
				files: {
					'public/js/application.min.js': [
					'app/assets/javascripts/application.js'
					]
				}
			},

			vendor: {
				files: {
					'public/js/jquery-1.10.2.min.js': 'bower_components/jquery/jquery.js',
					'public/js/vendor.min.js': [
					],
					'public/js/polyfill.min.js': [
					'bower_components/html5shiv/dist/html5shiv.js',
					'bower_components/respond/dest/respond.min.js'
					],
					'public/js/bootstrap.min.js': [
					'bower_components/sass-bootstrap/dist/js/bootstrap.min.js'
					],

				}
			}
		},

		jshint: {
			all: ['./app/js/*.js']			
		},


		imagemin: {
			dynamic: {
				files: [{
					expand: true,
					cwd:    'app/assets/images/',
					src:    ['**/*.{png,jpg,jpeg,gif}'],
					dest:   'public/img/'
				}]
			}
		}

	});

grunt.loadNpmTasks('grunt-contrib-watch');
grunt.loadNpmTasks('grunt-contrib-sass');
grunt.loadNpmTasks('grunt-contrib-uglify');
grunt.loadNpmTasks('grunt-contrib-imagemin');
grunt.loadNpmTasks('grunt-contrib-jshint');


grunt.registerTask('default', [
	'jshint',
	'sass',
	'uglify',
	'imagemin',
	'jshint'

	]);

};