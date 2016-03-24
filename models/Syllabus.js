var keystone = require('keystone');
var Types = keystone.Field.Types;

/**
 * Syllabus model
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var Syllabus = new keystone.List('Syllabus', 
	{
		label: 'Syllabus Page',
		singular: 'Syllabus Page',
		track: true,
		// nodelete: true,
		nocreate: true
	});

/**
 * Model Fields
 * @main About
 */
Syllabus.add({
	name: { type: Types.Name, label: 'Name', required: true, initial: true, index: true },
	title: { type: Types.Textarea, label: "Title", required: true },
	description: { type: Types.Textarea, label: "Description", required: true },
	file: {
		type: Types.AzureFile,
		dependsOn: { type: 'file' },
		label: 'File',
		filenameFormatter: function(item, filename) {
			return item.key + require('path').extname(filename);
		},
		containerFormatter: function(item, filename) {
			return 'syllabi';
		}
	},
	// fileSummary: { type: Types.Markdown, label: 'File Summary',
	// 	dependsOn: { type: ['file'] } },

	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Model Registration
 */
Syllabus.defaultSort = '-createdAt';
Syllabus.defaultColumns = 'name, updatedAt';
Syllabus.register();