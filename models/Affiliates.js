var keystone = require('keystone');
var Types = keystone.Field.Types;

/**
 * Affiliates model
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var Affiliates = new keystone.List('Affiliates', 
	{
		label: 'Affiliates Page',
		singular: 'Affiliates Page',
		track: true,
		// nodelete: true,
		nocreate: true
	});

/**
 * Model Fields
 * @main About
 */
Affiliates.add({
	name: { type: Types.Name, label: 'Name', required: true, initial: true, index: true },
	logo: { type: Types.CloudinaryImage, label: 'Logo', folder: 'site/logos' },
	
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Model Registration
 */
Affiliates.defaultSort = '-createdAt';
Affiliates.defaultColumns = 'name, updatedAt';
Affiliates.register();