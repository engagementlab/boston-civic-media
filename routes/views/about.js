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

var About = keystone.list('About');
var Affiliate = keystone.list('Affiliate');
var Funder = keystone.list('Funder');
var TeamMember = keystone.list('TeamMember');

var _ = require('underscore');

exports = module.exports = function(req, res) {

    var view = new keystone.View(req, res),
        locals = res.locals;

    // Init locals
    locals.section = 'about';

    view.on('init', function(next) {

        var queryAbout = About.model.findOne({}, {}, {
            sort: {
                'createdAt': -1
            }
        });

        queryAbout.exec(function(err, resultAbout) {

            // locals.about = resultAbout;
            // locals.about.historyImages1 = [];
            // locals.about.historyImages2 = [];
            // for (var i = 0; i < resultAbout.historyImages.length; i++) {
            //     if (i > 5) {
            //         break;
            //     } else if (i < 3) {
            //         locals.about.historyImages1.push(resultAbout.historyImages[i]);
            //     } else {
            //         locals.about.historyImages2.push(resultAbout.historyImages[i]);
            //     }
            // }

            var queryAffiliates = Affiliate.model.find({}).sort([
                ['sortOrder', 'ascending']
            ]);

            queryAffiliates.exec(function(err, resultAffiliates) {
                locals.affiliates = resultAffiliates;
                next(err);
            });
        });
    });

    // Render the view
    view.render('about');

};
