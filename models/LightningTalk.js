var keystone = require('keystone');
var Types = keystone.Field.Types;
var Video = require('./Video');

/**
 * LightningTalk model
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var LightningTalk = new keystone.List('LightningTalk', 
	{
		label: 'Lightning Talks',
		singular: 'Lightning Talk',
		track: true,
	    hidden: false,
	    autokey: { path: 'talk_key', from: 'name', unique: true },
		inherits: Video
		// nodelete: true,
		// nocreate: true
	});

/**
 * Model Fields
 * @main About
 */
LightningTalk.add({
	name: { type: String, label: "Name", note: "Will be set to the Talk Title value on 'save'", noedit: true, default: "name of talk", index: true},
	title: { type: String, label: "Talk Title", required: true, initial: true, index: true },
	longDescription: { type: Types.Markdown, label: 'Long Description', note: 'Shown on individual talk page. No character limit.', required: true, initial: true },
	talkDescription: { type: Types.Markdown, label: "Short Description", note: "Cut off at 300 characters. Appears in grid layout of talks.", max: {chars: 300, mode: 'validate'}, required: true, initial: true, index: true },
	category: { type: Types.Select, label: 'Type', options: 'Welcome, Art, Research, Technology, Media, Data, Co-Design', required: true, initial: true },
	enabled: {
      type: Types.Boolean,
      label: 'Enabled',
      note: 'Will never appear on site if not enabled'
  	},
  	homePage: {
      type: Types.Boolean,
      label: 'Appears on Home Page carousel'
  	},
  	featured: {
      type: Types.Boolean,
      label: 'Featured',
      note: 'Appears on Lightning Talk page. Only ONE Lightning Talk can be featured'
  	},
	
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }
});

LightningTalk.relationship({ ref: 'Event', path: 'talks' });

LightningTalk.schema.pre('save', function(next) {

    // Save state for post hook
    this.wasNew = this.isNew;
    this.wasModified = this.isModified();

    this.name = this.title;

    next();

});

/**
 * Model Registration
 */
LightningTalk.defaultSort = 'category';
LightningTalk.defaultColumns = 'title, category, enabled, homePage, featured';
LightningTalk.register();