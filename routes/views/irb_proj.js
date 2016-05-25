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

var IRBProj = keystone.list('IRBProj');
var _ = require('underscore');
var cloudinary = require('cloudinary');

exports = module.exports = function(req, res) {

    var view = new keystone.View(req, res),
        locals = res.locals;

    // Init locals
    locals.section = 'irb_proj';

    view.on('init', function(next) {

        // locals.featured_lightning_talks = [];

        var queryIrbProj = IRBProj.model.findOne({}, {}, {
            sort: {
                'createdAt': -1
            }
        });

        queryIrbProj.exec(function(err, resultIrbProj) {
            if (err) throw err;
            locals.irb_proj = resultIrbProj;
            // console.log (locals.irb_proj);
            next(err);
        });

    });

    // Render the view
    view.render('irb_proj');

};
