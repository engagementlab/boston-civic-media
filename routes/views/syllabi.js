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

        var filtersPopulate = [
                                {path:'institution', select:'key'},
                                {path:'discipline', select:'key'},
                                {path:'keyword', select:'key'},
                                {path:'faculty', select:'key'},
                                {path:'partnerOrg', select:'key'}
                              ];
        var querySyllabi = Syllabi.model.find({}).sort([
            ['sortOrder', 'ascending']
        ])
        .populate('institution')
        .populate('discipline')
        .populate('faculty')
        .populate('keyword')
        .populate('partnerOrg');

        var queryFilters = Filter.model.find({});

        querySyllabi.exec(function(err, resultSyllabi) {

            // var institutions = resultSyllabi.institution;
            queryFilters.exec(function(err, resultFilters) {

                locals.syllabi = resultSyllabi;

                _.each(locals.syllabi, function(syllabus) {

                    var filtersConcat = syllabus.institution.concat(syllabus.discipline, syllabus.faculty, syllabus.keyword);

                    if(syllabus.partnerOrg !== null || syllabus.partnerOrg !== undefined)
                        filtersConcat.concat(syllabus.partnerOrg);

                    syllabus.filters = _.pluck(filtersConcat, 'key').join(' ');

                });
            
                // Chain the result for filters and map them into arrays of labels after grouping them into sub-objects
                // http://underscorejs.org/#groupBy
                // http://underscorejs.org/#map
                locals.filters =
                _
                .chain(resultFilters)
                .groupBy('category')
                .map(function(filter, name) {
                    return {
                        label: name,
                        values: filter
                                .map(function(category, catKey) { 
                                    var key = category.key;
                                    var name = category.name; 
                                    return { "key": key,  "name": name }; 
                                })
                    };
                })
                .value();

                next(err);
            });

        });
    });

    // Render the view
    view.render('syllabi');

};
