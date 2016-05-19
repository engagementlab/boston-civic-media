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

var Event = keystone.list('Event');
var _ = require('underscore');
var cloudinary = require('cloudinary');

exports = module.exports = function(req, res) {

    var view = new keystone.View(req, res),
        locals = res.locals;

    // Init locals
    locals.section = 'events';

    view.on('init', function(next) {

        // locals.featured_lightning_talks = [];

        var queryEvent = Event.model.find({}).sort([
            ['sortOrder', 'ascending']
        ]);

        queryEvent.exec(function(err, resultEvent) {
            locals.events = resultEvent;

            next(err);
        });

    });

    // Render the view
    view.render('events');

};
