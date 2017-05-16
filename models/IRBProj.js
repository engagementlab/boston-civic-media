/**
 * Boston Civic Media Website
 * 
 * IRBProj page Model
 * @module IRBProj
 * @class IRBProj
 * @author Johnny Richardson
 * 
 * For field docs: http://keystonejs.com/docs/database/
 *
 * ==========
 */

var keystone = require('keystone');
var Types = keystone.Field.Types;

/**
 * IRBProj model
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var IRBProj = new keystone.List('IRBProj', 
	{
		label: 'IRB Project',
		singular: 'IRB Project',
				nodelete: true,
		nocreate: true
	});

/**
 * Model Fields
 * @main IRBProj
 */
IRBProj.add({
	name: { type: String, default: "Community IRB Project", hidden: true, required: true, initial: true },
	email: { type: String, label: "Contact Email", required: true, initial: true},
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
},
	'The Problem', {

        probTitle: {
            type: String,
            label: 'Title',
            initial: true,
            required: true
        },
        probText: {
            type: Types.Markdown,
            label: 'Text',
            initial: true,
            required: true
        }
  }, 
  'What We Did', {

        didTitle: {
            type: String,
            label: 'Title',
            initial: true,
            required: true
        },
        didText: {
            type: Types.Markdown,
            label: 'Text',
            initial: true,
            required: true
        }
  }, 
  'What We Found', {

        foundTitle: {
            type: String,
            label: 'Title',
            initial: true,
            required: true
        },
        foundText: {
            type: Types.Markdown,
            label: 'Text',
            initial: true,
            required: true
        }
  }, 
  'Next Steps', {

        nextTitle: {
            type: String,
            label: 'Title',
            initial: true,
            required: true
        },
        nextText: {
            type: Types.Markdown,
            label: 'Text',
            initial: true,
            required: true
        }
});

/**
 * Model Registration
 */
IRBProj.defaultSort = '-createdAt';
IRBProj.defaultColumns = 'name, imageTitle, imageCaption, email';
IRBProj.register();
