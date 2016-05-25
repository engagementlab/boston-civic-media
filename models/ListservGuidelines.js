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
var ListservGuidelines = new keystone.List('ListservGuidelines', 
	{
		label: 'Listserv Guidelines Page',
		singular: 'Listserv Guidelines Page',
		track: true
		// nodelete: true,
		// nocreate: true
	});

/**
 * Model Fields
 * @main Listserv
 */
ListservGuidelines.add({
	name: { type: String, hidden: true, required: true, initial: true },
	question: { type: String, label: "Question",  initial: true, required: true },
	answer: { type: Types.Textarea, label: "Answer",  initial: true, required: true },
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Model Registration
 */
ListservGuidelines.defaultSort = '-createdAt';
ListservGuidelines.defaultColumns = 'name, question, answer';
ListservGuidelines.register();
