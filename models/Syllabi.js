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
		sortable: true,
		sortContent: 'Filter:category',
    autokey: { path: 'syllabus_key', from: 'title', unique: true },
    map: { name: 'title' }
	});

// Storage adapter for Azure
var azureFile = new keystone.Storage({
  adapter: require('keystone-storage-adapter-azure'),
  azure: {
    container: 'bcmsyllabi',
    generateFilename: keystone.Storage.originalFilename
  },
  schema: {
    path: true,
    originalname: true,
    url: true
  }
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
          category: 'Faculty Member'
      },
      label: 'Faculty Members',
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
          category: 'Partnership Organization'
      },
      ref: 'Filter',
      label: 'Partner Organizations',
      many: true,
      // required: true,
      initial: true,
      note: 'This is optional'
  },
  title: { type: Types.Text, label: "Title", required: true, initial: true },
  blurb: { type: String, label: "Blurb/Short Description", note: 'Cut off at 300 characters. Appears below each syllabus in grids.', max: 300, required: true, initial: true },
	description: { type: Types.Textarea, label: "Long Description", note: 'CAN BE AS LONG AS YOU WANT. Appears on individual syllabus page', required: true, initial: true },
  file: {
		type: Types.File,
		label: 'File',
    storage: azureFile
	},
	enabled: {
      type: Types.Boolean,
      label: 'Enabled', 
      note: 'Will never appear on site if not enabled'
  },
  featured: {
      type: Types.Boolean,
      label: 'Featured', 
      note: 'There should be three syllabi featured for the front page.'
  },

	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Methods
 * =============
 */
// Remove a given filter from all syllabi that referenced it
Syllabi.schema.statics.removeFilterRef = function(filterId, callback) {

    Syllabi.model.update({
            $or: [{
                'institution': filterId
            }, {
                'discipline': filterId
            }, {
                'faculty': filterId
            }, {
                'keyword': filterId
            }, {
                'partnerOrg': filterId
            }]
        },

        {
            $pull: {
                'institution': filterId,
                'discipline': filterId,
                'faculty': filterId,
                'keyword': filterId,
                'partnerOrg': filterId
            }
        },

        {
            multi: true
        },

        function(err, result) {

            callback(err, result);

            if (err)
                console.error(err);
        }
    );

};

/**
 * Model Registration
 */
Syllabi.defaultSort = '-createdAt';
Syllabi.defaultColumns = 'title, blurb, institution, discipline, faculty, keyword, partnerOrg';
Syllabi.register();