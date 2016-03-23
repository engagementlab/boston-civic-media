
// Return server object
serverStart = function() {

	return require('express')();

};

// Any custom app initialization logic should go here
appStart = function(app) {

};

module.exports = function() {

	// Add main dependencies and EL-Website dependencies
	require('app-module-path').addPath(__dirname + '/node_modules'); 
	require('app-module-path').addPath(__dirname + '/../EL-Website/node_modules');
	
	// Obtain app root path and set as keystone's module root
	var appRootPath = require('app-root-path').path
	var keystoneInst = require('keystone');
	
	keystoneInst.set('module root', appRootPath);

	return { 

		keystone: keystoneInst,
		server: serverStart,
		start: appStart	

	}

}();