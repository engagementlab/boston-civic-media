/**
 * Boston Civic Media Website
 * 
 * Footer page Model
 * @module Footer
 * @class Footer
 * @author Johnny Richardson
 * 
 * For field docs: http://keystonejs.com/docs/database/
 *
 * ==========
 */

var keystone = require('keystone');
var Types = keystone.Field.Types;

/**
 * Footer model
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var Footer = new keystone.List('Footer', 
	{
		label: 'Footer Page',
		singular: 'Footer Page',
		nodelete: true,
		nocreate: true
	});

/**
 * Model Fields
 * @main Footer
 */
Footer.add({
    	name: { type: String, default: "Footer Page", hidden: true, required: true, initial: true },
        createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
    },
	'Stay Updated', {

        subscribe: {
            type: Types.Textarea,
            label: 'Subscribe Button Blurb'
        },
        subscribeLink: {
            type: String,
            label: 'Subscribe Button Link'
        },
        listserv: {
            type: Types.Textarea,
            label: 'Listserv Button Blurb'
        },
        listservLink: {
            type: String,
            label: 'Listserv Button Link'
        }
	}, 
	'Main Footer', {

        content: {
            type: Types.TextArray, 
            label: 'Footer Content',
            note: "Each content item will be displayed as an individual line in the footer.", 
            folder: 'site/logos'
    }
});

/**
 * Model Registration
 */
Footer.defaultSort = '-createdAt';
Footer.defaultColumns = 'name, updatedAt';
Footer.register();
