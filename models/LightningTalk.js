var keystone = require('keystone');
var Types = keystone.Field.Types;

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
		// nodelete: true,
		nocreate: true
	});

/**
 * Model Fields
 * @main About
 */
LightningTalk.add({
	name: { type: String, default: "About Page", hidden: true, required: true, initial: true },
	description: { type: Types.Name, label: 'Description', required: true, initial: true, index: true },
	footer: { type: Types.Name, label: "Footer", required: true, initial: true, index: true },

	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Model Registration
 */
LightningTalk.defaultSort = '-createdAt';
LightningTalk.defaultColumns = 'name, updatedAt';
LightningTalk.register();