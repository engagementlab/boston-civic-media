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
    hidden: false,
    autokey: { path: 'key', from: 'name', unique: true },
		inherits: Video
	});

/**
 * Model Fields
 * @main About
 */
LightningTalk.add({
	name: { type: String, label: "Title", note: "Should be UNDER 100 characters.", required: true, initial: true, index: true},
	longDescription: { type: Types.Markdown, label: 'Long Description', note: 'Shown on individual talk page. No character limit.', required: true, initial: true },
	short: { type: Types.Text, label: "Short Description", note: "Should be UNDER 300 characters. Appears in grid layout of talks.", max: {chars: 300, mode: 'validate'}, required: true, initial: true, index: true },
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

/**
 * Model Registration
 */
LightningTalk.defaultSort = 'category';
LightningTalk.defaultColumns = 'name, category, enabled, homePage, featured';
LightningTalk.register();