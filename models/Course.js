var keystone = require('keystone');
var Types = keystone.Field.Types;
// See: https://github.com/chriso/validator.js
var validator = require('validator');
var Filter = require('./Filter');

/**
 * Course model
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var Course = new keystone.List('Course', 
	{
		label: 'Courses',
		singular: 'Course',
		sortable: true,
    autokey: { path: 'course_key', from: 'name', unique: true }
	});

/**
 * Field Validators
 * @main Project
 */
var urlValidator = {
    validator: function(val) {
        return !val || validator.isURL(val, {
            protocols: ['http', 'https'],
            require_tld: true,
            require_protocol: false,
            allow_underscores: true
        });
    },
    msg: 'Invalid link URL (e.g. needs http:// and .org/)'
};

/**
 * Model Fields
 * @main Course
 */
Course.add({

  name: { type: Types.Text, label: "Course Name", required: true, initial: true },
  inst: {
    type: Types.Relationship,
    ref: 'Enroll',
    label: 'Enrollment Institution',
    required: true,
    initial: true, 
    note: 'Edit enrollment information on the Enroll model item.'
  },
  instructor: {
      type: Types.Relationship,
      filters: {
          category: 'Faculty Member'
      },
      label: 'Instructor(s)',
      ref: 'Filter',
      required: true,
      many: true,
      initial: true, 
      note: 'Edit individual instructor contact emails on this Instructor filter.'
  },
  description: { type: Types.Textarea, label: "Course Description", required: true, initial: true },
  // howTo: { type: Types.Markdown, label: "How To Enroll", required: true, initial: true, wysiwyg: true, toolbarOptions: { hiddenButtons: 'Code'  } },
  contactName: { type: Types.Text, label: "Contact Name", note: "e.g. 'Office of the Registrar'", required: true, initial: true },
  contactAddress: { type: Types.Location, label: "Contact Address", defaults: { state: "MA", country: 'United States' } },
  contactPhone: { type: Types.Text, label: "Contact Phone", length: 12 },
  contactUrl: { type: Types.Url, label: "Contact Website URL", validate: urlValidator, note: 'Must be in format "http://www.something.org"' },
  contactEmail: { type: Types.Email, label: "Contact Email" },

	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Methods
 * =============
 */
// Remove a given filter from all courses that referenced it
Course.schema.statics.removeFilterRef = function(filterId, callback) {

    Course.model.update({
            $or: [{
                'institution': filterId
            },
            {
                'faculty': filterId
            }]
        },

        {
            $pull: {
                'institution': filterId,
                'faculty': filterId
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
Course.defaultSort = '-createdAt';
Course.defaultColumns = 'name, institution';
Course.register();