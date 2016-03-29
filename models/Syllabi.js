var keystone = require('keystone');
var Types = keystone.Field.Types;

/**
 * Syllabi model
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var Syllabi = new keystone.List('Syllabi', 
	{
		label: 'Syllabi Page',
		singular: 'Syllabi Page',
		track: true
		// nodelete: true,
		// nocreate: true
	});

/**
 * Model Fields
 * @main About
 */
Syllabi.add({
	name: { type: Types.Name, label: 'Name', required: true, initial: true, index: true },
	title: { type: Types.Textarea, label: "Title", required: true, initial: true },
	description: { type: Types.Textarea, label: "Description", required: true, initial: true },
	file: {
		type: Types.AzureFile,
		label: 'File',
		filenameFormatter: function(item, filename) {
			return item.key + require('path').extname(filename);
		},
		containerFormatter: function(item, filename) {
			return 'bcmsyllabi';
		}
	},
	
	enabled: {
      type: Types.Boolean,
      label: 'Enabled'
  },
  featured: {
      type: Types.Boolean,
      label: 'Featured'
  },

	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Model Registration
 */
Syllabi.defaultSort = '-createdAt';
Syllabi.defaultColumns = 'name, updatedAt';
Syllabi.register();