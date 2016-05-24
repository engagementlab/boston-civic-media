/**
 * Boston Civic Media Website
 * 
 * TeamMember page parent Model
 * @module team
 * @author Johnny Richardson
 * 
 * For field docs: http://keystonejs.com/docs/database/
 *
 * ==========
 */

var keystone = require('keystone');
var Types = keystone.Field.Types;
var slack = keystone.get('slack');

/**
 * @module team
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var TeamMember = new keystone.List('TeamMember', 
	{
		label: 'Team Members',
		singular: 'Team Member',
		sortable: true,
		track: true,
		autokey: { path: 'key', from: 'name', unique: true },
	});

/**
 * Model Fields
 * @main Person
 */
TeamMember.add({

	name: { type: Types.Name, label: 'Name', required: true, initial: true, index: true },
	title: { type: String, label: 'Title', required: true, initial: true },
	bio: { type: Types.Markdown, label: 'Bio', required: true, initial: true },
	image: { type: Types.CloudinaryImage, label: 'Image', folder: 'site/team' },
	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }

});

/**
 * Hooks
 * =============
 */
TeamMember.schema.pre('save', function(next) {

    // Save state for post hook
    this.wasNew = this.isNew;
    this.wasModified = this.isModified();

    next();

});

TeamMember.schema.post('save', function(next) {

    // Make a post to slack when this Person is updated
    var team = this;
    
    slack.Post(
    	TeamMember.model, this, true, 
    	function() { return person.name.first + ' ' + person.name.last; }
    );

});


/**
 * Model Registration
 */
TeamMember.defaultSort = 'sortOrder';
TeamMember.defaultColumns = 'name, category';
TeamMember.register();
