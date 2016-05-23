/**
 * Boston Civic Media Website
 * 
 * Newsletter page Model
 * @module Newsletter
 * @class Newsletter
 * @author Johnny Richardson
 * 
 * For field docs: http://keystonejs.com/docs/database/
 *
 * ==========
 */

var keystone = require('keystone');
var Types = keystone.Field.Types;

/**
 * Newsletter model
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var Newsletter = new keystone.List('Newsletter', 
	{
		label: 'Newsletter Page',
		singular: 'Newsletter Page',
		track: true,
		// nodelete: true,
		nocreate: true
	});

/**
 * Model Fields
 * @main Newsletter
 */
Newsletter.add({
	name: { type: String, default: "Newsletter", hidden: true, required: true, initial: true },
	url: { type: String, label: 'URL', initial: true },
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Model Registration
 */
Newsletter.defaultSort = '-createdAt';
Newsletter.defaultColumns = 'name, updatedAt';
Newsletter.register();
