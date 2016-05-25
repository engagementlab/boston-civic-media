/**
 * Boston Civic Media Website
 * 
 * IRBProj page Model
 * @module IRBProj
 * @class IRBProj
 * @author Johnny Richardson
 * 
 * For field docs: http://keystonejs.com/docs/database/
 *
 * ==========
 */

var keystone = require('keystone');
var Types = keystone.Field.Types;

/**
 * IRBProj model
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var IRBProj = new keystone.List('IRBProj', 
	{
		label: 'IRB Project',
		singular: 'IRB Project',
		track: true
		// nodelete: true,
		// nocreate: true
	});

/**
 * Model Fields
 * @main IRBProj
 */
IRBProj.add({
	name: { type: String, default: "Community IRB Project", hidden: true, required: true, initial: true },
	description: { type: Types.Textarea, label: "Description", required: true, initial: true},
	image: { type: Types.CloudinaryImage, label: 'Image',  folder: 'boston-civic-media/logos' },

	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Model Registration
 */
IRBProj.defaultSort = '-createdAt';
IRBProj.defaultColumns = 'name, updatedAt';
IRBProj.register();
