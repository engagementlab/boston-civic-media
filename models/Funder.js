var keystone = require('keystone');
var Types = keystone.Field.Types;

/**
 * Funder model
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var Funder = new keystone.List('Funder', 
	{
		label: 'Funders',
		singular: 'Funder',
		track: true
		// nodelete: true,
		// nocreate: true
	});

/**
 * Model Fields
 * @main About
 */
Funder.add({
	name: { type: String, label: 'Name', required: true, initial: true, index: true },
	logo: { type: Types.CloudinaryImage, label: 'Logo',  folder: 'boston-civic-media/logos' },
	
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Model Registration
 */
Funder.defaultSort = '-createdAt';
Funder.defaultColumns = 'name, updatedAt';
Funder.register();