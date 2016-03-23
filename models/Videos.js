/**
 * Engagement Lab Website
 * 
 * Videos page parent Model
 * @module Videos
 * @author Johnny Richardson
 * 
 * For field docs: http://keystonejs.com/docs/database/
 *
 * ==========
 */

var keystone = require('keystone');
var Types = keystone.Field.Types;
var slack = keystone.get('slack');

/**
 * @module Videos
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var Videos = new keystone.List('Videos', 
	{
		label: 'Videos',
		singular: 'Videos Member',
		sortable: true,
		track: true,
		autokey: { path: 'key', from: 'name', unique: true },
	});

/**
 * Model Fields
 * @main Person
 */
Videos.add({

	title: { type: String, label: 'Name', required: true, initial: true, index: true },
	//embedLink: { type: Types.URL, label: 'Video Embed Link', required: true, initial: true },
	description: { type: String, label: 'Description', required: true, initial: true, index: true },

 //  category: { type: Types.Select, options: 'leadership, Videos, fellows, students, alumni', default: 'Videos', required: true, initial: true },
	// twitterURL: { type: Types.Url, label: 'Twitter' },	
	// fbURL: { type: Types.Url, label: 'Facebook' },	
	// linkedInURL: { type: Types.Url, label: 'LinkedIn' },	
	// githubURL: { type: Types.Url, label: 'Github' },
	// websiteURL: { type: Types.Url, label: 'Website' },	

	// email: { type: String, label: 'Email' },
	// phone: { type: String, label: 'Phone' },
	
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }

});

/**
 * Hooks
 * =============
 */
Videos.schema.pre('save', function(next) {

    // Save state for post hook
    this.wasNew = this.isNew;
    this.wasModified = this.isModified();

    next();

});

Videos.schema.post('save', function(next) {

    // Make a post to slack when this Person is updated
    var Videos = this;
    
    slack.Post(
    	Videos.model, this, true, 
    	function() { return person.name.first + ' ' + person.name.last; }
    );

});


/**
 * Model Registration
 */
Videos.defaultSort = 'sortOrder';
Videos.defaultColumns = 'name, category';
Videos.register();
