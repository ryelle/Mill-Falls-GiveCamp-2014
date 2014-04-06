module.exports = function(grunt) {

    // 1. All configuration goes here
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        imagemin: {
            dynamic: {
                files: [{
                    expand: true,
                    cwd: 'images/',
                    src: ['**/*.{png,jpg,gif}'],
                    dest: 'images/'
                }]
            }
        },
        sass: {
            dist: {
                options: {
                    // Can be nested, compact, compressed, expanded
                    style: 'expanded',
                    noCache: true
                },
                files: {
                    'style.css': 'scss/style.scss',
                    'rtl.css': 'scss/rtl.scss',
                    'editor-style.css': 'scss/editor-style.scss',
                }
            }
        },
        autoprefixer: {
            options: {
                // Task-specific options go here.
            },
            global: {
                options: {
                    // Target-specific options go here.
                    // browser-specific info: https://github.com/ai/autoprefixer#browsers
                    // DEFAULT: browsers: ['> 1%', 'last 2 versions', 'ff 17', 'opera 12.1']
                    browsers: ['> 1%', 'last 2 versions', 'ff 17', 'opera 12.1', 'ie 8', 'ie 9']
                },
                src: 'style.css'
            },
        },
        watch: {
            scss: {
                files: ['scss/*.scss', 'scss/**/*.scss', 'scss/**/**/*.scss'],
                tasks: ['sass', 'autoprefixer'],
                options: {
                    livereload: true,
                    spawn: false,
                }
            }
        }
    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    grunt.loadNpmTasks('grunt-contrib-imagemin');   // optimize images
    grunt.loadNpmTasks('grunt-contrib-watch');      // watch files for changes
    grunt.loadNpmTasks('grunt-contrib-sass');       // Gettin Sassy!
    grunt.loadNpmTasks('grunt-autoprefixer');       // Auto-freaking-prefixer!!!

    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('default', ['sass','imagemin']);

};