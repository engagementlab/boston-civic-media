
// Return server object
serverStart = function() {

	return require('express')();

};

// Any custom app initialization logic should go here
appStart = function(app) {

};

module.exports = function() {

	var keystoneInst = require('keystone');	
	keystoneInst.set('module root', __dirname);

	return { 

		keystone: keystoneInst,
		server: serverStart,
		start: appStart	

	}

}();