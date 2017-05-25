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
var CoursePage = keystone.list('CoursePage');
var _ = require('underscore');
var cloudinary = require('cloudinary');

exports = module.exports = function(req, res) {

    var view = new keystone.View(req, res),
        locals = res.locals;

    // Init locals
    locals.section = 'courses';

    view.on('init', function(next) {

        var queryCourses = Course.model.find({}).sort([
            ['sortOrder', 'ascending']
        ])
        .populate('institution', 'name contactEmail')
        .populate('instructor', 'name');
        var queryCoursePage = CoursePage.model.findOne({}, {}, {
            sort: {
                'createdAt': -1
            }
        });

        queryCourses.exec(function(err, resultCourses) {
            queryCoursePage.exec(function(err, resultPage) {

                locals.courses = resultCourses;
                locals.page = resultPage;

                next();
                
            });
        });
    });

    // Render the view
    view.render('courses');

};
