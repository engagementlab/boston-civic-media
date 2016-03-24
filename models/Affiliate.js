var keystone = require('keystone');
var Types = keystone.Field.Types;

/**
 * Affiliate model
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var Affiliate = new keystone.List('Affiliate', 
	{
		label: 'Affiliate Page',
		singular: 'Affiliate Page',
		track: true,
		// nodelete: true,
		nocreate: true
	});

/**
 * Model Fields
 * @main About
 */
Affiliate.add({
	name: { type: Types.Name, label: 'Name', required: true, initial: true, index: true },
	logo: { type: Types.CloudinaryImage, label: 'Logo', folder: 'site/logos' },
	
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Model Registration
 */
Affiliate.defaultSort = '-createdAt';
Affiliate.defaultColumns = 'name, updatedAt';
Affiliate.register();