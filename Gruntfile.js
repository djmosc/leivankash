module.exports = function(grunt) {
    
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        compass: {
            dev: {
                options: {
                    config: 'config.rb'
                }
            }
        },
        cssmin: {
            options: {
                keepSpecialComments: 0,
                stripBanners: true,
                banner: '/*\n Date compiled: <%= grunt.template.today("yyyy-mm-dd h:MM:ss") %>\n*/\n\n',
            },
            live: {
                files: {
                    'css/style.min.css': ['css/style.css']
                }
            }
        },
        concat: {
            plugins: {
                files: {
                    'js/plugins.js': ['js/plugins/jquery.easing.js', 'js/plugins/jquery.scroller.js', 'js/plugins/jquery.actual.js', 'js/plugins/jquery.imagesloaded.js', 'js/plugins/jquery.transit.js']
                }
            },
            live: {
                files: {
                    'js/script.js': ['js/modernizr.js', 'js/plugins.js', 'js/main.js']
                }
            }
        },
        jshint: {
            all: ['Gruntfile.js', 'js/main.js']
        },
        uglify: {
             options: {
                stripBanners: true,
                banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - <%= grunt.template.today("yyyy-mm-dd") %> */',
            },
            live: {
                files: {
                    'js/script.min.js': ['js/script.js']
                }
            }
        },
        watch: {
            options: {
               spawn: true
            },
            css: {
                files: ['css/scss/*.scss'],
                tasks: ['compass', 'notify:watch']
            },
            livereload: {
                options: { 
                    livereload: true 
                },
                files: ['css/style.css'],
            },//,
            // js: {
            //     files: ['js/main.js'],
            //     tasks: ['jshint'],
            //     options: {
            //        livereload: true
            //     }
            // }
        },
        notify: {
            watch: {
                options: {
                    title: 'SASS',  // optional
                    message: 'Sucessfully compiled', //required
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-notify');

    grunt.registerTask('default', ['compass', 'concat:plugins', 'uglify']);
    grunt.registerTask('live', ['compass', 'cssmin', 'concat:plugins', 'concat:live', 'uglify:live']);
    grunt.registerTask('css', ['compass', 'cssmin']);
    grunt.registerTask('javascript', ['concat', 'uglify']);
};