var keystone = require('keystone');
var Types = keystone.Field.Types;

/**
 * GettingInvolved model
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var GettingInvolved = new keystone.List('GettingInvolved', 
	{
		label: 'Getting Involved Page',
		singular: 'Getting Involved Page',
		track: true,
		// nodelete: true,
		nocreate: true
	});

/**
 * Model Fields
 * @main About
 */
GettingInvolved.add({
	name: { type: String, default: "Getting Involved Page", hidden: true, required: true, initial: true },
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
},

	'Educators', {

        description: {
            type: String,
            label: 'Description',
            initial: true,
            required: true
        },
        blurb: {
            type: Types.TextArray,
            label: 'Blurb'
        }
  }, 

  'Comm Orgs', {

        description: {
            type: String,
            label: 'Description',
            initial: true,
            required: true
        },
        blurb: {
            type: Types.TextArray,
            label: 'Blurb'
        }
  }, 

  'Researchers', {

        description: {
            type: String,
            label: 'Description',
            initial: true,
            required: true
        },
        blurb: {
            type: Types.TextArray,
            label: 'Blurb'
        }
  }, 

  'Students', {

        description: {
            type: String,
            label: 'Description',
            initial: true,
            required: true
        },
        blurb: {
            type: Types.TextArray,
            label: 'Blurb'
        }
  });

/**
 * Model Registration
 */
GettingInvolved.defaultSort = '-createdAt';
GettingInvolved.defaultColumns = 'name, updatedAt';
GettingInvolved.register();