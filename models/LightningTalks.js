var keystone = require('keystone');
var Types = keystone.Field.Types;

/**
 * LightningTalks model
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var LightningTalks = new keystone.List('LightningTalks', 
	{
		label: 'LightningTalks Page',
		singular: 'LightningTalks Page',
		track: true,
		// nodelete: true,
		nocreate: true
	});

/**
 * Model Fields
 * @main About
 */
LightningTalks.add({
	name: { type: String, default: "About Page", hidden: true, required: true, initial: true },
	description: { type: Types.Name, label: 'Description', required: true, initial: true, index: true },
	footer: { type: Types.Name, label: "Footer", required: true, initial: true, index: true },

	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Model Registration
 */
LightningTalks.defaultSort = '-createdAt';
LightningTalks.defaultColumns = 'name, updatedAt';
LightningTalks.register();