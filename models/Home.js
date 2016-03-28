/**
 * Boston Civic Media Website
 * 
 * Home page Model
 * @module Home
 * @class Home
 * @author Johnny Richardson
 * 
 * For field docs: http://keystonejs.com/docs/database/
 *
 * ==========
 */

var keystone = require('keystone');
var Types = keystone.Field.Types;

/**
 * Home model
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var Home = new keystone.List('Home', 
	{
		label: 'Home Page',
		singular: 'Home Page',
		track: true,
		// nodelete: true,
		nocreate: true
	});

/**
 * Model Fields
 * @main Home
 */
Home.add({
	name: { type: String, default: "Home Page", hidden: true, required: true, initial: true },
	vision: { type: Types.Textarea, label: "Vision", initial: true, required: true },
	description: { type: Types.Textarea, label: "Description", initial: true, required: true },
	
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Model Registration
 */
Home.defaultSort = '-createdAt';
Home.defaultColumns = 'name, updatedAt';
Home.register();
