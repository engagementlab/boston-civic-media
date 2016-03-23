var keystone = require('keystone');
var Types = keystone.Field.Types;

/**
 * Funders model
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var Funders = new keystone.List('Funders', 
	{
		label: 'Funders Page',
		singular: 'Funders Page',
		track: true,
		// nodelete: true,
		nocreate: true
	});

/**
 * Model Fields
 * @main About
 */
Funders.add({
	name: { type: Types.Name, label: 'Name', required: true, initial: true, index: true },
	logo: { type: Types.CloudinaryImage, label: 'Logo', folder: 'site/logos' },
	
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Model Registration
 */
Funders.defaultSort = '-createdAt';
Funders.defaultColumns = 'name, updatedAt';
Funders.register();