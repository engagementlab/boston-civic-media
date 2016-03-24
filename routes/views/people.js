/**
 * Boston Civic Media Website
 * Developed by Engagement Lab, 2016
 * ==============
 * People view controller.
 *
 * Help: http://keystonejs.com/docs/getting-started/#routesviews-firstview
 *
 * @class team
 * @author Johnny Richardson
 *
 * ==========
 */
var keystone = require('keystone');

exports = module.exports = function(req, res) {

    var view = new keystone.View(req, res),
        locals = res.locals;

    // Init locals
    locals.section = 'people';

    // Load all team members and sort/categorize them 
    view.on('init', function(next) {

        /*var q = Person.model.find({}).sort([
            ['sortOrder', 'ascending']
        ]);
        var categorize = function(val, cat) {
            return val.filter(function(item) {
                return item.category == cat;
            });
        };

        // Setup the locals to be used inside view
        q.exec(function(err, result) {

            locals.leadership = categorize(result, 'leadership');
            locals.team  = categorize(result, 'team');
            locals.fellows = categorize(result, 'fellows');
            locals.students = categorize(result, 'students');
            locals.alumni = categorize(result, 'alumni');

            next(err);
        });*/
        
            next(err);

    });

    // Render the view
    view.render('people');

};
