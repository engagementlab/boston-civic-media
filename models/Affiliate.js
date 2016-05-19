/**
 * Boston Civic Media Website
 * 
 * Affiliate page Model
 * @module models
 * @class affiliate
 * @author Johnny Richardson
 * 
 * For field docs: http://keystonejs.com/docs/database/
 *
 * ==========
 */
var keystone = require('keystone');
var Types = keystone.Field.Types;

var Affiliate = new keystone.List('Affiliate', 
	{
		label: 'Affiliate Page',
		singular: 'Affiliate Page',
		track: true
		// nodelete: true,
		// nocreate: true
	});

/**
 * Model Fields
 * @main About
 */
Affiliate.add({
	name: { type: Types.Name, label: 'Name', required: true, initial: true, index: true },
	logo: { type: Types.CloudinaryImage, label: 'Logo', folder: 'site/logos' },
	comm: {
      type: Types.Boolean,
      label: 'Community Organization'
 	},
  	univ: {
      type: Types.Boolean,
      label: 'University'
  	},
  	city: {
      type: Types.Boolean,
      label: 'City Agency'
  	},
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Model Registration
 */
Affiliate.defaultSort = '-createdAt';
Affiliate.defaultColumns = 'name, updatedAt';
Affiliate.register();