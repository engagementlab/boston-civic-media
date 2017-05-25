var keystone = require('keystone');
var Types = keystone.Field.Types;

/**
 * CoursePage model
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var CoursePage = new keystone.List('CoursePage', 
	{
		label: 'Courses Page Content',
		singular: 'Courses Page Content',
    nocreate: true
	});

/**
 * Model Fields
 * @main CoursePage
 */
CoursePage.add({

  name: { type: Types.Text, label: "Page Name", default: "Courses Page Content", required: true, initial: true },
  pageTitle: { type: Types.Text, label: "Page Title", note: "e.g. '2017-2018 Consortium Course Catalog'", required: true, initial: true },
  pageBlurb: { type: Types.Textarea, label: "Page Blurb", note: "Content under title", required: true, initial: true },
  featureHeadings: { type: Types.TextArray, label: "Feature Headings", note: "Requirements, Availability, Registration headings", required: true, initial: true },
  featureContent: { type: Types.TextArray, label: "Feature Content", note: "Requirements, Availability, Registration content", required: true, initial: true },

	createdAt: { type: Date, default: Date.now, noedit: true, hidden: true }

});

/**
 * Model Registration
 */
CoursePage.defaultSort = '-createdAt';
CoursePage.defaultColumns = 'name';
CoursePage.register();