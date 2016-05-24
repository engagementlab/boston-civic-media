/**
 * Boston Civic Media Website
 * 
 * Event page Model
 * @module models
 * @class Event
 * @author Johnny Richardson
 * 
 * For field docs: http://keystonejs.com/docs/database/
 *
 * ==========
 */
var keystone = require('keystone');
var Types = keystone.Field.Types;

var Event = new keystone.List('Event', 
	{
		label: 'Event Page',
		singular: 'Event Page',
		track: true, 
		autokey: { path: 'event_key', from: 'title', unique: true }
		// nodelete: true,
		// nocreate: true
	});

/**
 * Model Fields
 * @main About
 */
Event.add({
	name: { type: Types.Name, label: 'Name', required: true, initial: true, index: true },
	title: { type: Types.Text, label: 'Title', required: true, initial: true, index: true },
	image: { type: Types.CloudinaryImage, label: 'Event Image',  folder: 'bcm/logos' },
	description: { type: Types.Textarea, label: 'Description', required: true, initial: true, index: true },
	footer: { type: Types.Textarea, label: 'Footer', required: true, initial: true, index: true },
	// url: { type: String, label: 'URL', hidden: true},
	past: {
      type: Types.Boolean,
      label: 'Past Event'
 	},
  	featured: {
      type: Types.Boolean,
      label: 'Featured Event'
  	},
  	enabled: {
      type: Types.Boolean,
      label: 'Enabled'
  	},
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Model Registration
 */
Event.defaultSort = '-createdAt';
Event.defaultColumns = 'name, updatedAt';
Event.register();