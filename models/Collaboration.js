/**
 * Boston Civic Media Website
 * 
 * Listserv page Model
 * @module Listserv
 * @class Listserv
 * @author Johnny Richardson
 * 
 * For field docs: http://keystonejs.com/docs/database/
 *
 * ==========
 */

var keystone = require('keystone');
var Types = keystone.Field.Types;

/**
 * Listserv model
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var Collaboration = new keystone.List('Collaboration', 
	{
		label: 'Collaboration Page',
		singular: 'Collaboration Page',
		track: true
		// nodelete: true,
		// nocreate: true
	});

/**
 * Model Fields
 * @main Listserv
 */
Collaboration.add({
	name: { type: String, hidden: true, required: true, initial: true },
	title: { type: String, label: "Collaborator",  initial: true, required: true },
	text: { type: Types.Textarea, label: "Collaborated with..",  initial: true, required: true },
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Model Registration
 */
Collaboration.defaultSort = '-createdAt';
Collaboration.defaultColumns = 'name, question, answer';
Collaboration.register();
