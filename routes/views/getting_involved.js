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
var ListservGuidelines = keystone.list('ListservGuidelines');
var Newsletter = keystone.list ('Newsletter');
var GettingInvolved = keystone.list('GettingInvolved');
var _ = require('underscore');
var cloudinary = require('cloudinary');

exports = module.exports = function(req, res) {

    var view = new keystone.View(req, res),
        locals = res.locals;

    // Init locals
    locals.section = 'getting_involved';

    view.on('init', function(next) {

        locals.guidelines = [];
        locals.newsletters = [];

        var queryGettingInvolved = GettingInvolved.model.find({}).sort([
            ['sortOrder', 'ascending']
        ]);

        var queryGuidelines = ListservGuidelines.model.find({}).sort([
            ['sortOrder', 'ascending']
        ]);

        var queryNewsletters = Newsletter.model.find({}).sort([
            ['sortOrder', 'ascending']
        ]);

        queryGettingInvolved.exec(function(err, resultGettingInvolved) {
          
            locals.getting_involved = resultGettingInvolved[0];

            queryGuidelines.exec(function(err, resultGuidelines) {
          
                locals.guidelines = resultGuidelines;
          
                queryNewsletters.exec(function(err, resultNewsletters) {
                    
                    locals.newsletters = resultNewsletters;
                    
                    next(err);

                    console.log (locals.getting_involved);

                });

            });
        });

    });

    // Render the view
    view.render('getting_involved');

};
