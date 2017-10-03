/**
 * Boston Civic Media Website
 * 
 * Video page parent Model
 * @module Video
 * @author Johnny Richardson
 * 
 * For field docs: http://keystonejs.com/docs/database/
 *
 * ==========
 */
'use strict';

var keystone = require('keystone');
var mongoose = keystone.mongoose;
var Types = keystone.Field.Types;
var slack = keystone.get('slack');

/**
 * @module Video
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var Video = new keystone.List('Video', 
	{
		label: 'Video',
		singular: 'Video',
    hidden: true,
		sortable: true,
				autokey: { path: 'key', from: 'name', unique: true },
	});

/**
 * Model Fields
 * @main Person
 */
Video.add({
	url: { type: String, label: 'Video URL', initial: true },
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});
Video.schema.add({
	data: { type: mongoose.Schema.Types.Mixed, hidden: true }
});

/**
 * Hooks
 * =============
 */
Video.schema.pre('save', function(next) {

		// HTTP requester
		let request = require('request');
		let url = 'https://vimeo.com/api/oembed.json?url=' + this.url;

		if(this.url.indexOf('youtube.com') !== -1)
			url = 'http://www.youtube.com/oembed?url=' + this.url + '&format=json';

    // Save state for post hook
    this.wasNew = this.isNew;
    this.wasModified = this.isModified();

    request(url, (error, response, articleBody) => {

    	this.data = JSON.parse(response.body);

	    next();

    });

});

/**
 * Model Registration
 */
Video.defaultSort = 'sortOrder';
Video.defaultColumns = 'url, createdAt';
Video.register();

exports = module.exports = Video;
