var async = require('async'),
	keystone = require('keystone');
var LightningTalk = keystone.list('LightningTalk');

exports = module.exports = function(done) {

	LightningTalk.model.find({}).exec(function(err, items) {
		
		if (err) return res.apiError('database error', err);
		if (!items) return res.apiError('not found');
		
		for (var i=0; i<items.length; i++) {
        
      LightningTalk.model.findOneAndUpdate({_id: items[i].id}, {$set:{
      	shortDescription:items[i]._doc.talkDescription.md
      }}, {new: true}, function (err, doc) {

		    if(err)
		    	return res.apiError(err);
      });
     
     } 

     done();
	
	});

}
