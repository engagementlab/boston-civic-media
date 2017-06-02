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
var Collab = keystone.list('Collaboration');
var TeamMember = keystone.list('TeamMember');

var _ = require('underscore');

exports = module.exports = function(req, res) {

    var view = new keystone.View(req, res),
        locals = res.locals;

    // Init locals
    locals.section = 'about';

    view.on('init', function(next) {

        locals.affiliates = [];
        locals.funders = [];
        locals.teamMembers = [];


        var queryAbout = About.model.findOne({}, {}, {
            sort: {
                'createdAt': -1
            }
        });

        // var teamQuery = TeamMember.model.find({
        //     locals.teamMember 
        // });

        queryAbout.exec(function(err, resultAbout) {
            if (err) throw err;

            locals.about = resultAbout;
            // console.log (locals.about)

            var queryAffiliates = Affiliate.model.find({}).sort([
                ['sortOrder', 'ascending']
            ]);

            queryAffiliates.exec(function(err, resultAffiliates) {
                if (err) throw err;
                locals.affiliates = resultAffiliates;

                var queryTeam = TeamMember.model.find({}).sort([
                    ['sortOrder', 'ascending']
                ]);

                queryTeam.exec(function(err, resultTeamMembers) {
                    if (err) throw err;
                    locals.teamMembers = resultTeamMembers;

                    var queryFunders = Funder.model.find({}).sort([
                        ['sortOrder', 'ascending']
                    ]);

                    queryFunders.exec(function(err, resultFunders) {
                        if (err) throw err;
                        locals.funders = resultFunders;

                        next(err);
                    });
                });
            });
        });
    });

    // Render the view
    view.render('about');

};
