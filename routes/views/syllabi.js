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
var Filter = keystone.list('Filter');
var Syllabi = keystone.list('Syllabi');
var _ = require('underscore');
var cloudinary = require('cloudinary');

exports = module.exports = function(req, res) {

    var view = new keystone.View(req, res),
        locals = res.locals;

    // Init locals
    locals.section = 'syllabi';

    view.on('init', function(next) {

        locals.filters = [];
        locals.disciplines = [];

        var querySyllabi = Syllabi.model.find({}).sort([
            ['sortOrder', 'ascending']
        ])
        .populate('institution discipline');

        var queryFilters = Filter.model.find({});

        querySyllabi.exec(function(err, resultSyllabi) {

            // var institutions = resultSyllabi.institution;
            queryFilters.exec(function(err, resultFilters){
                // console.log (err)
                locals.filters = resultFilters;
                // locals.disciplines = resultFilters.discipline;
            });
            // locals.institutions = resultSyllabi.institution;
            // console.log (locals.institutions);
            locals.syllabi = resultSyllabi;
            // console.log (locals.syllabi);

            next(err);
        });
    });

    // Render the view
    view.render('syllabi');

};
