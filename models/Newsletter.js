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
var _ = require('underscore');
var Types = keystone.Field.Types;

/**
 * Newsletter model
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var Newsletter = new keystone.List('Newsletter', 
	{
		label: 'Newsletter',
		singular: 'Newsletter',
		track: true
		// nodelete: true,
		// nocreate: true
	});

/**
 * Model Fields
 * @main Newsletter
 */
Newsletter.add({
	name: { type: String, default: "Newsletter", hidden: true, required: true, initial: true },
	url: { type: String, label: 'URL', initial: true },
	publishedAt: {type: Types.Datetime, default: Date.now},
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Model Registration
 */
// Newsletter._.published = Date.format ('MM-DD-YYYY');
Newsletter.defaultSort = '-createdAt';
Newsletter.defaultColumns = 'name, url, published';
Newsletter.register();
