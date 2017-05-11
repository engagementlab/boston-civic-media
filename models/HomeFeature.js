/**
 * Boston Civic Media Website
 * 
 * Home Feature Model
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

var HomeFeature = new keystone.List('HomeFeature', 
	{
		label: 'Home Features',
		singular: 'Home Feature',
		sortable: true,
		track: true,
    autokey: { path: 'key', from: 'name', unique: false }
	});

/**
 * Model Fields
 * 
 */
HomeFeature.add({
	name: { type: String, label: 'Feature Heading', required: true, initial: true, index: true },
	description: { type: String, label: 'Description', required: true, initial: true },
	url: { type: String, label: 'Link URL', note: 'Must be in format "/this/url".', required: false }
});

/**
 * Model Registration
 */
HomeFeature.defaultSort = 'name';
HomeFeature.defaultColumns = 'name';
HomeFeature.register();