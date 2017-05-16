/**
 * Boston Civic Media Website
 * Developed by Engagement Lab, 2016
 * ==============
 * Courses page view controller.
 *
 * Help: http://keystonejs.com/docs/getting-started/#routesviews-firstview
 *
 * @class courses
 * @author 
 *
 * ==========
 */
var keystone = require('keystone');
var Filter = keystone.list('Filter');
var Course = keystone.list('Course');
var _ = require('underscore');
var cloudinary = require('cloudinary');

exports = module.exports = function(req, res) {

    var view = new keystone.View(req, res),
        locals = res.locals;

        console.log('locals', res.locals)

    // Init locals
    locals.section = 'courses';

    view.on('init', function(next) {

        var queryCourses = Course.model.find({}).sort([
            ['sortOrder', 'ascending']
        ])
        .populate('institution', 'name contactEmail')
        .populate('instructor', 'name');

        queryCourses.exec(function(err, resultCourses) {

            locals.courses = resultCourses;

            next();
        });
    });

    // Render the view
    view.render('courses');

};
