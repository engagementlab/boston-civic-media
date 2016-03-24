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
	vision: { type: Types.Textarea, label: "Vision", required: true },
	description: { type: Types.Textarea, label: "Description", required: true },
	// history1: { type: Types.Textarea, label: "History Paragraph 1", required: true },
	// history2: { type: Types.Textarea, label: "History Paragraph 2", required: true },
	// history3: { type: Types.Textarea, label: "History Paragraph 3", required: true },
	// history4: { type: Types.Textarea, label: "History Paragraph 4", required: false },
	// historyImages: {
	// 	type: Types.CloudinaryImages,
	// 	label: 'History Images (Please use 6 images)',
	// 	folder: 'site/Home',
	// 	autoCleanup: true
	// },
	// process: { type: Types.Textarea, label: "Process and Approach", required: true },
	
	// collaborate: { type: Types.Textarea, label: "Collaborate With Us", required: true },
	// studentsResearchers: { type: Types.Textarea, label: "Students and Researchers", required: true },
	// clientsConsulting: { type: Types.Textarea, label: "Clients and Consulting", required: true },
	// partnerships: { type: Types.Textarea, label: "Community Based Partnerships", required: true },
	
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Model Registration
 */
Home.defaultSort = '-createdAt';
Home.defaultColumns = 'name, updatedAt';
Home.register();
