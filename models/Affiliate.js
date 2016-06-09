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
		label: 'Affiliates',
		singular: 'Affiliate',
		sortable: true,
		track: true
		// nodelete: true,
		// nocreate: true
	});

/**
 * Model Fields
 * @main About
 */
Affiliate.add({
	name: { type: String, label: 'Name', required: true, initial: true, index: true },
	logo: { type: Types.CloudinaryImage, label: 'Logo', folder: 'site/logos' },
	link: { type: String, label: 'Affiliate URL Link', required:true, initial:true},
	category: { type: Types.Select, label: 'Type', options: 'University, CityAgency, Organization', required: true, initial: true },
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Model Registration
 */
Affiliate.defaultSort = 'category';
Affiliate.defaultColumns = 'name, category';
Affiliate.register();