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

var Syllabi = keystone.list('Syllabi');
var _ = require('underscore');
var cloudinary = require('cloudinary');

exports = module.exports = function(req, res) {

    var view = new keystone.View(req, res),
        locals = res.locals;

    // Init locals
    locals.section = 'syllabi';

    view.on('init', function(next) {

        var querySyllabi = Syllabi.model.find({}).sort([
            ['sortOrder', 'ascending']
        ]);

        querySyllabi.exec(function(err, resultSyllabi) {
            locals.syllabi = resultSyllabi;
            console.log (locals.syllabi);

            next(err);
        });
    });

    // Render the view
    view.render('syllabi');

};
