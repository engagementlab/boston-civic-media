/**
 * Boston Civic Media Website
 * Developed by Engagement Lab, 2016
 * ==============
 * Syllabi page view controller.
 *
 * Help: http://keystonejs.com/docs/getting-started/#routesviews-firstview
 *
 * @class syllabi
 * @author 
 *
 * ==========
 */
var keystone = require('keystone');
var Collaboration = keystone.list('Collaboration');

var _ = require('underscore');
var cloudinary = require('cloudinary');

exports = module.exports = function(req, res) {

    var view = new keystone.View(req, res),
        locals = res.locals;

    // Init locals
    locals.section = 'getting_involved';

    view.on('init', function(next) {

        // locals.collaborations = [];
        

        var queryCollab = Collaboration.model.find({}).sort([
            ['sortOrder', 'ascending']
        ]);

        
        queryCollab.exec(function(err, result) {
          
            locals.collaborations = result;
            next(err);

           
        });

    });

    // Render the view
    view.render('collaborations');

};
