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

var GettingInvolved = keystone.list('GettingInvolved');
var _ = require('underscore');
var cloudinary = require('cloudinary');

exports = module.exports = function(req, res) {

    var view = new keystone.View(req, res),
        locals = res.locals;

    // Init locals
    locals.section = 'getting_involved';

    view.on('init', function(next) {

        locals.featured_lightning_talks = [];

        var queryGettingInvolved = GettingInvolved.model.find({}).sort([
            ['sortOrder', 'ascending']
        ]);

        queryGettingInvolved.exec(function(err, resultGettingInvolved) {
            locals.getting_involved = resultGettingInvolved;

            next(err);
        });

    });

    // Render the view
    view.render('lightning_talk');

};
