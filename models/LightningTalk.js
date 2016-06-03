var keystone = require('keystone');
var Types = keystone.Field.Types;
var Video = require('./Video');

/**
 * LightningTalk model
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var LightningTalk = new keystone.List('LightningTalk', 
	{
		label: 'Lightning Talks',
		singular: 'Lightning Talk',
		track: true,
	    hidden: false,
		inherits: Video
		// nodelete: true,
		// nocreate: true
	});

/**
 * Model Fields
 * @main About
 */
LightningTalk.add({
	// name: { type: Types.Name, label: "Name", default: "Lightning Talks", hidden: true, required: true, initial: true },
	title: { type: String, label: "Talk Title", required: true, initial: true, index: true },
	description: { type: String, label: "Talk Description", note: "Should be no longer than 2-3 sentences.", required: true, initial: true, index: true },
	category: { type: Types.Select, label: 'Type', options: 'Technology, Media, Data, Co-Design', required: true, initial: true },
	enabled: {
      type: Types.Boolean,
      label: 'Enabled'
  	},
  	homePage: {
      type: Types.Boolean,
      label: 'Appears on Home Page carousel'
  	},
  	featured: {
      type: Types.Boolean,
      label: 'Featured',
      note: 'Appears on Lightning Talk page. Only ONE Lightning Talk can be featured'
  	},
	
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Model Registration
 */
LightningTalk.defaultSort = 'category';
LightningTalk.defaultColumns = 'title, category, enabled, homePage, featured';
LightningTalk.register();