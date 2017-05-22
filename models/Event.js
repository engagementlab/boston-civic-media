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
		label: 'Events',
		singular: 'Event',
				autokey: { path: 'event_key', from: 'name', unique: true },
		hidden: false
	});

/**
 * Model Fields
 * @main About
 */
Event.add({

  name: { type: String, default: 'Name of Event', required: true, initial: true, index: true },
	date: { type: Date, label: 'Event Date', default: Date.now, required: true, initial: true },
	image: { type: Types.CloudinaryImage, label: 'Event Image',  folder: 'boston-civic-media/logos' },
	theDescription: { type: Types.Markdown, label: 'Long Description', note: 'Shown on individual event page. No character limit.', required: true, initial: true },
	theFooter: { type: Types.Markdown, label: 'Short Description', note: 'Shown in events grid page. Should be no more than 120 characters.', required: true, initial: true },
	eventbriteURL: { type: String, label: 'Eventbrite URL'},
	hackpadURL: {type: String, label: 'Hackpad URL'}, 
	additionalURL: { type: String, label: "Summary Blog Post URL"},
	talks: {
      type: Types.Relationship,
      ref: 'LightningTalk',
      label: 'Associated Lightning Talks',
      many: true
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

Event.schema.pre('save', function(next) {

    // Save state for post hook
    this.wasNew = this.isNew;
    this.wasModified = this.isModified();

    next();

});

Event.schema.statics.removeResourceRef = function(resourceId, callback) {

   Event.model.update({
            $or: [{
                'talks': resourceId
            }]
        },

        {
            $pull: {
                'talks': resourceId
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
Event.defaultSort = '-createdAt';
Event.defaultColumns = 'name, footer, featured, enabled';
Event.register();