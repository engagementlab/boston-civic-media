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
				nodelete: true,
		nocreate: true
	});

/**
 * Model Fields
 * @main About
 */
GettingInvolved.add({
	name: { type: String, default: "Getting Involved Page", hidden: true, required: true, initial: true },
    banner: { type: Types.CloudinaryImage, label: 'Banner Image',  folder: 'boston-civic-media/banner' },
    subHeader: { type: String, label: "Subheader Text", note: "Subheader is under banner", initial: true, required: true },
    listservLink: { type: String, label: "Listserv URL", initial: true, required: true},
    listservBlurb: { type: String, label: "Listserv Blurb", initial: true, required: true},
    contactEmail: { type: String, label: "Contact Email", initial: true, required: true},
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
},
	'Educators', {

        edDescription: {
            type: String,
            label: 'Description',
            initial: true,
            required: true
        },
        edBlurb: {
            type: Types.TextArray,
            label: 'Bullet Point Lines'
        }

  }, 

  'Organizations', {

        orgsDescription: {
            type: String,
            label: 'Description',
            initial: true,
            required: true
        },
        orgBlurb: {
            type: Types.TextArray,
            label: 'Bullet Point Lines'
        }
  }, 

  'Researchers', {

        resDescription: {
            type: String,
            label: 'Description',
            initial: true,
            required: true
        },
        resBlurb: {
            type: Types.TextArray,
            label: 'Bullet Point Lines'
        }
  }, 

  'Students', {

        studDescription: {
            type: String,
            label: 'Description',
            initial: true,
            required: true
        },
        studBlurb: {
            type: Types.TextArray,
            label: 'Bullet Point Lines'
        }
    });

/**
 * Model Registration
 */
GettingInvolved.defaultSort = '-createdAt';
GettingInvolved.defaultColumns = 'name, updatedAt';
GettingInvolved.register();