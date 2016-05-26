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
		track: true
		// nodelete: true,
		// nocreate: true
	});

/**
 * Model Fields
 * @main About
 */
GettingInvolved.add({
	name: { type: String, default: "Getting Involved Page", hidden: true, required: true, initial: true },
    banner: { type: Types.CloudinaryImage, label: 'Banner Image',  folder: 'boston-civic-media/logos' },
    listservLink: { type: String, label: "Listserv Link", initial: true, required: true},
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
            label: 'Blurb'
        },
        // edImage: { type: Types.CloudinaryImage, label: 'Image',  folder: 'bcm/team' }

  }, 

  'Comm Orgs', {

        orgsDescription: {
            type: String,
            label: 'Description',
            initial: true,
            required: true
        },
        orgsBlurb: {
            type: Types.TextArray,
            label: 'Blurb'
        },
        // orgsImage: { type: Types.CloudinaryImage, label: 'Image',  folder: 'bcm/team' }
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
            label: 'Blurb'
        },
        // resImage: { type: Types.CloudinaryImage, label: 'Image',  folder: 'bcm/team' }
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
            label: 'Blurb'
        },
        // studImage: { type: Types.CloudinaryImage, label: 'Image',  folder: 'bcm/team' }
    });

/**
 * Model Registration
 */
GettingInvolved.defaultSort = '-createdAt';
GettingInvolved.defaultColumns = 'name, updatedAt';
GettingInvolved.register();