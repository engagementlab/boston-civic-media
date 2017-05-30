/**
 * This file is where you define your application routes and controllers.
 *
 * Start by including the middleware you want to run for every request;
 * you can attach middleware to the pre('routes') and pre('render') events.
 *
 * For simplicity, the default setup for route controllers is for each to be
 * in its own file, and we import all the files in the /routes/views directory.
 *
 * Each of these files is a route controller, and is responsible for all the
 * processing that needs to happen for the route (e.g. loading data, handling
 * form submissions, rendering the view template, etc).
 *
 * Bind each route pattern your application should respond to in the function
 * that is exported from this module, following the examples below.
 *
 * See the Express application routing documentation for more information:
 * http://expressjs.com/api.html#app.VERB
 */

var express = require('express');
var router = express.Router();
var keystone = require('keystone');
var middleware = require('./middleware');
var importRoutes = keystone.importer(__dirname);

// Common Middleware
keystone.pre('routes', middleware.initErrorHandlers);
keystone.pre('render', middleware.initLocals);
keystone.pre('render', middleware.flashMessages);
keystone.pre('render', middleware.Footer);

// Import Route Controllers
var routes = {
    views: importRoutes('./views')
};

// Setup Route Bindings 

// /keystone redirect
router.all('/admin', function(req, res, next) {
    res.redirect('/keystone');
});

// Views
router.get('/', routes.views.index);

router.get('/about', routes.views.about);
router.get('/courses', routes.views.courses);
router.get('/syllabi', routes.views.syllabi);
router.get('/syllabus/:syllabus_key', routes.views.syllabus);
router.get('/lightning-talks', routes.views.lightning_talks);
router.get('/lightning-talks/:talk_key', routes.views.lightning_talk);
router.get('/irb-proj', routes.views.irb_proj);
router.get('/get-involved', routes.views.getting_involved);
router.get('/collaborations', routes.views.collaboration);
router.get('/events', routes.views.events);
router.get('/events/:event_key', routes.views.event);
// router.get('/people/:person', routes.views.person);

// DEPRECATED
router.get('/irb_proj', routes.views.irb_proj);
router.get('/getting_involved', routes.views.getting_involved);
router.get('/lightning_talks', routes.views.lightning_talks);
router.get('/lightning_talks/:talk_key', routes.views.lightning_talk);
router.get('/syllabi/:syllabus_key', routes.views.syllabus);

// NOTE: To protect a route so that only admins can see it, use the requireUser middleware:
// router.get('/protected', middleware.requireUser, routes.views.protected);

module.exports = router;
