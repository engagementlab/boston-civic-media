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
		label: 'LightningTalk Page',
		singular: 'LightningTalk Page',
		track: true,
		inherits: Video
		// nodelete: true,
		// nocreate: true
	});

/**
 * Model Fields
 * @main About
 */
LightningTalk.add({
	name: { type: Types.Name, label: "Name", default: "Lightning Talks", hidden: true, required: true, initial: true },
	title: { type: String, label: "Talk Title", required: true, initial: true, index: true },
	description: { type: String, label: "Talk Description", required: true, initial: true, index: true },
	enabled: {
      type: Types.Boolean,
      label: 'Enabled'
  	},
  	featured: {
      type: Types.Boolean,
      label: 'Featured'
  	},
	
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Model Registration
 */
LightningTalk.defaultSort = '-createdAt';
LightningTalk.defaultColumns = 'name, updatedAt';
LightningTalk.register();