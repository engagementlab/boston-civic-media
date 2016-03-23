// IMPORTANT
// console.log(__dirname)
// require('app-module-path').addPath(__dirname);

// Return server object
serverStart = function() {

	return require('express')();

};

// Any custom app initialization logic should go here
appStart = function(app) {
// require('app-module-path').addPath(__dirname + '/node_modules/engagement-lab/node_modules/');
};

module.exports = function() { return { 
		keystone: require('keystone'),
		server: serverStart,
		start: appStart	
}}();