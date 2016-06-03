/**
 * Boston Civic Media Website
 * Developed by Engagement Lab, 2016
 * ==============
 * About page view controller.
 *
 * Help: http://keystonejs.com/docs/getting-started/#routesviews-firstview
 *
 * @class about
 * @author 
 *
 * ==========
 */
var keystone = require('keystone');
var Footer = keystone.list('Footer');

var _ = require('underscore');

exports = module.exports = function(req, res) {

    var view = new keystone.View(req, res),
        locals = res.locals;

    // Init locals
    locals.section = 'footer';

    view.on('init', function(next) {

        var queryFooter = Footer.model.findOne({}, {}, {
            sort: {
                'createdAt': -1
            }
        });

        queryFooter.exec(function(err, resultFooter) {
            if (err) throw err;

            locals.footer = resultFooter;
        });

    });

    // Render the view
    view.render('footer');

};
