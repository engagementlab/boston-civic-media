/**
 * Boston Civic Media Website
 * Developed by Engagement Lab, 2016
 * ==============
 * Home page view controller.
 *
 * Help: http://keystonejs.com/docs/getting-started/#routesviews-firstview
 *
 * @class index
 * @static
 * @author Johnny Richardson
 *
 * ==========
 */
var keystone = require('keystone');

// Include models here!
//var Project = keystone.list('Project')
var Syllabi = keystone.list('Syllabi');

var _ = require('underscore');

// News data propagated by ./jobs/news
var store = require('json-fs-store')('./tmp');

exports = module.exports = function(req, res) {

    var view = new keystone.View(req, res);
    var locals = res.locals;

    // locals.section is used to set the currently selected
    // item in the header navigation.
    locals.section = 'home';

    // Make any queries
    view.on('init', function(next) {

        //locals.featured_content = [];
        locals.featured_syllabi = [];

        // EXAMPLE OF QUERY TO GET FEATURED STUFF
        // This query gets all featured projects
        var syllabiQuery = Syllabi.model.find({
            'enabled': true,
            'featured': true
        })
        .populate('subdirectory');

        // Setup the locals to be used inside view
        syllabiQuery.exec(function(err, result) {
            if (err) throw err;
            locals.featured_syllabi = result;

            // NewsBox.model.find({}).exec(function(err, result) {
            //     locals.featured_content = result;
            //     next();
            // });
        });
    next();

    });

    // Render the view
    view.render('index');

};
