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
// var Video = require('./Video');
var Types = keystone.Field.Types;


var Event = new keystone.List('Event', 
	{
		label: 'Event Page',
		singular: 'Event Page',
		track: true, 
		autokey: { path: 'event_key', from: 'title', unique: true },
		// inherits: Video,
		hidden: false
		// nodelete: true
		// nocreate: true
	});

/**
 * Model Fields
 * @main About
 */
Event.add({
	theTitle: { type: Types.Markdown, label: 'Title', note: "All titles must be split into two lines to display properly", required: true, initial: true, index: true },
	image: { type: Types.CloudinaryImage, label: 'Event Image',  folder: 'boston-civic-media/logos' },
	theDescription: { type: Types.Markdown, label: 'Long Description', note: 'Shown on individual event page. No character limit.', required: true, initial: true },
	theFooter: { type: Types.Markdown, label: 'Short Description', note: 'Shown in events grid page. Should be no more than 150 characters.', required: true, initial: true },
	eventbriteURL: { type: String, label: 'Eventbrite URL'},
	hackpadURL: {type: String, label: 'Hackpad URL'}, 
	additionalURL: { type: String, label: "Additional URL"},
	videoLinks: { type: Types.TextArray, label: "Lightning Talk Links"},
	file: {
		type: Types.AzureFile,
		label: 'File',
		filenameFormatter: function(item, filename) {
      // console.log ("hi");
			return item.event_key + require('path').extname(filename);
		},
		containerFormatter: function(item, filename) {
			return 'bcmevent';
		}
	},
  	featured: {
      type: Types.Boolean,
      label: 'Featured Event', 
      note: 'Only one event should be featured'
  	},
  	enabled: {
      type: Types.Boolean,
      label: 'Enabled',
      note: 'Will never appear on site if not enabled'
  	},
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

/**
 * Model Registration
 */
Event.defaultSort = '-createdAt';
Event.defaultColumns = 'title, footer, featured, enabled';
Event.register();