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

var LightningTalk = keystone.list('LightningTalk');
var _ = require('underscore');
var cloudinary = require('cloudinary');

exports = module.exports = function(req, res) {

    var view = new keystone.View(req, res),
        locals = res.locals;

    // Init locals
    locals.section = 'lightning_talk';

    view.on('init', function(next) {

        locals.featured_lightning_talks = [];

        var queryLightningTalk = LightningTalk.model.find({}).sort([
            ['sortOrder', 'ascending']
        ]);

        var featuredTalkQuery = LightningTalk.model.find({
            'enabled': true,
            'featured': true
        });

        queryLightningTalk.exec(function(err, resultLightningTalk) {
            locals.lightning_talk = resultLightningTalk;
            // console.log (locals.lightning_talk)
            // console.log ("hi")

            next(err);
        });

        featuredTalkQuery.exec(function(err, result){
            console.log ("hi")
            if (err) throw err;
            locals.featured_lightning_talks = result;
        });


    });

    // Render the view
    view.render('lightning_talk');

};
