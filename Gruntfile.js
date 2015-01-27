module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		compass: {                  // Task
			dist: {                   // Target
				options: {              // Target options
					sassDir: 'sass',
					cssDir: 'css',
					environment: 'production'
				}
			},
			dev: {                    // Another target
				options: {
					sassDir: 'sass',
					cssDir: 'css'
				}
			}
		},
		'ftp-deploy': {
			build: {
				auth: {
					host: 'ftp.laurenpittenger.com',
					port: 21,
					authKey: 'live'
				},
				src: '/Applications/MAMP/htdocs/thepartedheart/wp-content/themes/thepartedheart',
				dest: '/thepartedheart/wp-content/themes/thepartedheart',
				exclusions: [
					'thepartedheart/.DS_Store',
					'/Applications/MAMP/htdocs/thepartedheart/wp-content/themes/thepartedheart/node_modules',
					'/Applications/MAMP/htdocs/thepartedheart/wp-content/themes/thepartedheart/.ftppass',
					'/Applications/MAMP/htdocs/thepartedheart/wp-content/themes/thepartedheart/.git',
					'path/to/dist/tmp'
				]
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.loadNpmTasks('grunt-ftp-deploy');

	grunt.registerTask('default', ['compass']);
	grunt.registerTask('deploy', ['ftp-deploy']);
};