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
var Home = keystone.list('Home');
var LightningTalk = keystone.list('LightningTalk');
var Syllabi = keystone.list('Syllabi');
var Event = keystone.list('Event')
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

        locals.featured_lightning_talks = [];
        locals.featured_syllabi = [];
        locals.featured_events = [];

        var homeQuery = Home.model.findOne({}, {}, {
            sort: {
                'createdAt': -1
            }
        })
        .populate('features');
        var syllabiQuery = Syllabi.model.find({
            'enabled': true,
            'featured': true
        })
        .populate('faculty');
        var queryEvents = Event.model.find({
            'enabled': true
        });
        
        // Setup the locals to be used inside view
        homeQuery.exec(function(err, result) {
            
            if (err) throw err;
            
            if(result !== null)
                locals.features = result.features;
            
            queryEvents.exec(function(err, resultEvents) {
                if (err) throw err;

                if(resultEvents)
                    locals.events = resultEvents;
                
                syllabiQuery.exec(function(err, resultSyllabi) {
                    if (err) throw err;
                    
                    if(resultSyllabi)
                        locals.featured_syllabi = resultSyllabi;
                    
                    next(err);
                });
            });

        });

    });

    // Render the view
    view.render('index');

};