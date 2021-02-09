/* jshint node:true */
module.exports = function( grunt ) {
	'use strict';

	const pluginName = 'smart-docs';
	const textDomain = 'smart-docs';
	const buildPath = 'build/smart-docs/';
	const pkg = grunt.file.readJSON( 'package.json' );

	grunt.initConfig({
		pkg,

		// Add text-domain.
		addtextdomain: {
			options: {
				textdomain: textDomain,
				updateDomains: ['smartdocs']  // List of text domains to replace.
			},
			target: {
				files: {
					src: [
						'*.php',
						'**/*.php',
						'!node_modules/**',
						'!vendor/**',
					]
				}
			}
		},

		// Check textdomain errors.
		checktextdomain: {
			options:{
				text_domain: textDomain,
				keywords: [
					'__:1,2d',
					'_e:1,2d',
					'_x:1,2c,3d',
					'esc_html__:1,2d',
					'esc_html_e:1,2d',
					'esc_html_x:1,2c,3d',
					'esc_attr__:1,2d',
					'esc_attr_e:1,2d',
					'esc_attr_x:1,2c,3d',
					'_ex:1,2c,3d',
					'_n:1,2,4d',
					'_nx:1,2,4c,5d',
					'_n_noop:1,2,3d',
					'_nx_noop:1,2,3c,4d'
				]
			},
			files: {
				src:  [
					'**/*.php',               // Include all files
					'!node_modules/**',       // Exclude node_modules/
					'!vendor/**',             // Exclude vendor/
				],
				expand: true
			}
		},

		// Generate POT files.
		makepot: {
			options: {
				type: 'wp-plugin',
				domainPath: 'languages',
				potHeaders: {
					poedit: true,                   // Includes common Poedit headers.
                	'x-poedit-keywordslist': true   // Include a list of all possible gettext functions.
				}
			},
			dist: {
				options: {
					potFilename: 'smart-docs.pot',
					exclude: [
						'node_modules/.*',
						'vendor/.*',
					]
				}
			}
		},

		// PHP Code Sniffer.
		phpcs: {
			options: {
				bin: 'vendor/bin/phpcs'
			},
			dist: {
				src:  [
					'**/*.php', // Include all php files.
					'!node_modules/**',
					'!vendor/**'
				]
			}
		},

		copy: {
            main: {
                expand: true,
                src: [
					'**',
					'!.distignore',
					'!.gitignore',
					'!.gitattributes',
					'!.editorconfig',
					'!.jshintrc',
					'!.stylelintrc',
					'!.env',
					'!*.sh',
					'!*.map',
					'!*.zip',
                    '!Gruntfile.js',
                    '!postcss.config.js',
                    '!tailwind.config.js',
                    '!.wp-env.js',
                    '!package.json',
					'!README.md',
					'!codesniffer.ruleset.xml',
					'!ruleset.xml',
                    '!composer.json',
                    '!composer.lock',
                    '!package-lock.json',
                    '!phpcs.xml.dist',
                    '!phpcs.xml',
                    '!node_modules/**',
                    '!.git/**',
                    '!.github/**',
                    '!.vscode/**',
                    '!bin/**',
					'!vendor/**',
					'!build/**',
					'!assets/*.scss',
					'!assets/**/*.map',
					'!*~'
                ],
                dest: buildPath
            }
		},
		
		compress: {
            main: {
                options: {
                    archive: pluginName + '.zip',
                    mode: 'zip'
                },
                files: [
                    {
						cwd: 'build/',
						expand: true,
                        src: [
                            '**'
                        ]
                    }
                ]
            },
        },

		clean: {
            main: ['build'],
            zip: ['*.zip']
        },

		bumpup: {
            options: {
                updateProps: {
                    pkg: 'package.json'
                }
            },
            file: 'package.json'
        },

		// Replace.
		replace: {
			main: {
				src: ['smart-docs.php'],
				overwrite: true,
				replacements: [
					{
						from: /(Version:\s+)(\d+(\.\d+){0,3})([^\n^\.\d]?.*?)(\n)/,
						to: 'Version: <%= pkg.version %>\n'
					},
					{
						from: /SMART_DOCS_VERSION', '.*?'/g,
						to: 'SMART_DOCS_VERSION\', \'<%= pkg.version %>\''
					},
				]
			},

			comments: {
				src: [
					'*.php',
                    '**/*.php',
					'!node_modules/**',
					'!vendor/**',
					'!i18n/**',
					'!build/**'
				],
				overwrite: true,
				replacements: [
					{
						from: 'x.x.x',
						to: '<%= pkg.version %>'
					}
				]
			}
		}
	});

	// Load NPM tasks to be used here.
	grunt.loadNpmTasks( 'grunt-phpcs' );
	grunt.loadNpmTasks( 'grunt-checktextdomain' );
	grunt.loadNpmTasks( 'grunt-contrib-copy' );
	grunt.loadNpmTasks( 'grunt-contrib-clean' );
	grunt.loadNpmTasks( 'grunt-contrib-compress' );
	grunt.loadNpmTasks( 'grunt-wp-i18n' );
	grunt.loadNpmTasks( 'grunt-bumpup' );
	grunt.loadNpmTasks( 'grunt-text-replace' );

	// Register tasks.
	grunt.registerTask( 'default', [
		'i18n'
	] );

	grunt.registerTask( 'assets', [
		'js',
		'css'
	] );

	grunt.registerTask( 'i18n', [
		'addtextdomain',
		'checktextdomain',
		'makepot'
	] );

	// Bump Version - `grunt version-bump --ver=<version-number>`
    grunt.registerTask( 'version-bump', function (ver) {
        var version = grunt.option( 'ver' );

        if ( version ) {
            version = version ? version : 'patch';

            grunt.task.run( 'bumpup:' + version );
            grunt.task.run( 'replace' );
        } else {
			throw new Error( 'Provide version with parameter --ver.' );
		}
	} );
	
	// Release.
    grunt.registerTask( 'release', [
		'clean:zip',
		'copy:main',
		'compress:main',
		'clean:main'
	] );
};