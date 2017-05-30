var keystone = require('keystone');
var Types = keystone.Field.Types;

/**
 * Enroll model
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var Enroll = new keystone.List('Enroll', 
	{
		label: 'Enrollment Information Content',
		singular: 'Enrollment Information Content',
    nocreate: false
	});

/**
 * Model Fields
 * @main Enroll
 */
Enroll.add({

  name: { type: Types.Text, label: "Institution Name", required: true, initial: true, note: 'This is the name of the institution.' },
  info: { type: Types.Markdown, label: "Enrollment Information", note: "This information will display in the 'Enrollment Information' section on the courses page. Use h2 tags for headings, but no other tags.", required: true, initial: true },

	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }

});

/**
 * Model Registration
 */
Enroll.defaultSort = '-createdAt';
Enroll.defaultColumns = 'name';
Enroll.register();