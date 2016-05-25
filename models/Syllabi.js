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
		label: 'Syllabi',
		singular: 'Syllabus',
		track: true, 
		sortable: true,
		sortContent: 'Filter:category',
    autokey: { path: 'syllabus_key', from: 'title', unique: true }
		// nodelete: true,
		// nocreate: true
	});

/**
 * Model Fields
 * @main About
 */
Syllabi.add({
	// name: { type: Types.Name, label: 'Name', required: true, initial: true, index: true },
	institution: {
      type: Types.Relationship,
      filters: {
          category: 'Institution'
      },
      ref: 'Filter',
      label: 'Institutions',
      required: true,
      many: true,
      initial: true
  },
  discipline: {
      type: Types.Relationship,
      filters: {
          category: 'Discipline'
      },
      ref: 'Filter',
      label: 'Disciplines',
      required: true,
      many: true,
      initial: true
  },
  faculty: {
      type: Types.Relationship,
      filters: {
          category: 'Faculty'
      },
      ref: 'Filter',
      required: true,
      many: true,
      initial: true
  },
  keyword: {
      type: Types.Relationship,
      filters: {
          category: 'Keyword'
      },
      ref: 'Filter',
      label: 'Keywords',
      required: true,
      many: true,
      initial: true
  },
  partnerOrg: {
      type: Types.Relationship,
      filters: {
          category: 'Partner Organization'
      },
      ref: 'Filter',
      label: 'Partner Organizations',
      many: true,
      initial: true,
      note: 'This is optional'
  },
  title: { type: Types.Text, label: "Title", required: true, initial: true },
  blurb: { type: String, label: "Short Description", note: 'Appears below each syllabus in grids', required: true, initial: true },
	description: { type: Types.Textarea, label: "Long Description", note: 'Appears on individual syllabus page', required: true, initial: true },
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
 * Hooks
 * =============
 */
Syllabi.schema.pre('save', function(next) {

    // Filter.populate(this.institution, )

    // // Save state for post hook
    // this.filters = Object.assign(this.discipline, this.institution);

    // console.log(this.filters)

    next();

});

/**
 * Model Registration
 */
Syllabi.defaultSort = '-createdAt';
Syllabi.defaultColumns = 'title, blurb, institution, discipline, faculty, keyword, partnerOrg';
Syllabi.register();