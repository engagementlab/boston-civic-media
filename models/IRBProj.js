/**
 * Engagement Lab Website
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
		label: 'IRBProj Page',
		singular: 'IRBProj Page',
		track: true,
		// nodelete: true,
		nocreate: true
	});

/**
 * Model Fields
 * @main IRBProj
 */
IRBProj.add({
	name: { type: String, default: "Community IRB Project", hidden: true, required: true, initial: true },
	description: { type: Types.Textarea, label: "Description", required: true },
	
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Model Registration
 */
IRBProj.defaultSort = '-createdAt';
IRBProj.defaultColumns = 'name, updatedAt';
IRBProj.register();
