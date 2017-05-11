// Site-wide JS
module.exports = function(grunt, options) {
  // Obtain env to generate filename
  var env = grunt.option('env');

  if(env === undefined) {
    
    grunt.log.writeln('No env provided, checking NODE_ENV');
    
    if(process.env.NODE_ENV !== undefined)
      env = process.env.NODE_ENV;
    else {
      grunt.log.subhead('No env provided, defaulting to production!');
      env = 'production'
    }

  }

  grunt.log.writeln('Compiling ' + env + '.js');

  // Output file is relative to this site
  var fileOut = __dirname + '/../public/release/' + env + '.js';
  var config = { uglify: { files: {} } };

  // Files to uglify
  config.uglify.files[fileOut] = [

    __dirname + '/../public/js/*.js', // js for the site
    __dirname + '/../public/plugins/*.js',  // Plugins
    __dirname + '/../public/plugins/**/*.js',
    '!' + __dirname + '/../public/plugins/isotope/*.js',  // Ignore isotope (this is a seperate prod include)
    __dirname + '/../public/plugins/bxslider/jquery.bxslider.js',
    __dirname + '/../public/bower_components/cloudinary-core/cloudinary-core-shrinkwrap.js'
  
  ];

  return config;
  
}
        