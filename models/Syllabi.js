var keystone = require('keystone');
var Types = keystone.Field.Types;
var Filter = require('./Filter')

/**
 * Syllabi model
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var Syllabi = new keystone.List('Syllabi', 
	{
		label: 'Syllabus',
		singular: 'Syllabi',
		track: true, 
		sortable: true,
		sortContent: 'Filter:category'
		// nodelete: true,
		// nocreate: true
	});

/**
 * Model Fields
 * @main About
 */
Syllabi.add({
	name: { type: Types.Name, label: 'Name', required: true, initial: true, index: true },
	institution: {
        type: Types.Relationship,
        filters: {
            category: 'Institution'
        },
        ref: 'Filter',
        required: true,
        initial: true
    },
    discipline: {
        type: Types.Relationship,
        filters: {
            category: 'Discipline'
        },
        ref: 'Filter',
        required: true,
        initial: true
    },
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