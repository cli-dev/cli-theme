// Gruntfile.js

// our wrapper function (required by grunt and its plugins)
// all configuration goes inside this function
module.exports = function(grunt) {

  // ===========================================================================
  // CONFIGURE GRUNT ===========================================================
  // ===========================================================================
  grunt.initConfig({

    // get the configuration info from package.json ----------------------------
    // this way we can use things like name and version (pkg.name)
    pkg: grunt.file.readJSON('package.json'),

    // configure jshint to validate js files -----------------------------------
    jshint: {
      options: {
        reporter: require('jshint-stylish')
      }
    },
    compass: {
      prod: {
        options: {
          relativeAssets: true,
          sourcemap: true,
          environment: 'production',
          cssDir: 'css/min',
          sassDir: 'sass',
          imagesDir: 'imgs',
          javascriptsDir: 'js',
          outputStyle: 'compressed',
          fontsPath: 'fonts',
          imagesPath: 'imgs',
          require: ['breakpoint']
        }
      },
      admin: {
        options: {
          relativeAssets: true,
          sourcemap: true,
          environment: 'production',
          cssDir: 'admin/css',
          sassDir: 'admin/sass',
          imagesDir: 'imgs',
          javascriptsDir: 'admin/js',
          outputStyle: 'compressed',
          fontsPath: 'fonts',
          imagesPath: 'imgs',
          require: ['breakpoint']
        }
      }
    },
    concat: {
      options: {
        sourceMap: true,
      },
      css: {
        src: ['css/vendor/animate.min.css','css/vendor/hover-min.css','css/vendor/jquery.fancybox.min.css','css/vendor/owl.carousel.min.css','css/min/style.css'],
        dest: 'css/production/style.css',
      },
      jsheader: {
        src: ['js/vendor/modernizr.min.js','js/vendor/webfont.js','js/vendor/jquery.fancybox.min.js','js/vendor/jquery.nicescroll.min.js','js/vendor/headhesive.min.js'],
        dest: 'js/header-scripts.js',
      },
      jsfooter: {
        src: ['js/vendor/jquery.transit.min.js','js/vendor/midnight.jquery.min.js', 'js/vendor/jquery.hoverIntent.min.js','js/vendor/jquery.scrollTo.min.js','js/vendor/wow.min.js','js/vendor/owl-carousel/owl.carousel.min.js','js/vendor/jquery.waypoints.min.js','js/vendor/sticky.min.js','js/vendor/inview.min.js','js/vendor/infinite.min.js','js/scripts.js'],
        dest: 'js/footer-scripts.js',
      },
    },
    watch: {
      scripts: {
        files: ['js/**/*.js'],
        tasks: ['jshint', 'concat:jsheader', 'concat:jsfooter', 'sync:js']
      },
      css: {
        files: ['sass/**/*.scss'],
        tasks: ['compass:prod', 'compass:admin', 'concat:css', 'sync:css'],
      },
      admin: {
        files: ['admin/**/*.scss'],
        tasks: ['compass:admin', 'sync:admin'],
      }
    },
    sync: {
      css: {
        files: [
          {expand: true, src: ['css/**'], dest: 'W:/clithemewp/wp-content/themes/cli-theme/'},
        ],
      },
      js: {
        files: [
          {expand: true, src: ['js/**'], dest: 'W:/clithemewp/wp-content/themes/cli-theme/'},
        ],
      },
      admin: {
        files: [
          {expand: true, src: ['admin/**'], dest: 'W:/clithemewp/wp-content/themes/cli-theme/'},
        ],
      }
    },
  });
  

  // ===========================================================================
  // LOAD GRUNT PLUGINS ========================================================
  // ===========================================================================
  // we can only load these if they are in our package.json
  // make sure you have run npm install so our app can find these
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-compass');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-sync');
};
