
// Return server object
serverStart = function() {

	return require('express')();

};

// Any custom app initialization logic should go here
appStart = function(app) {

};

module.exports = function(frameworkDir, shared) {

	require('app-module-path').addPath(frameworkDir + '/node_modules'); 
	
	// Obtain app root path and set as keystone's module root
	var appRootPath = require('app-root-path').path;
	var keystoneInst = require('keystone');	

	return { 

		keystone: keystoneInst,
		server: serverStart,
		start: appStart	

	}

};