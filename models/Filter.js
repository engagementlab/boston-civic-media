/**
 * Engagement Lab Website
 * 
 * Research category Modelz
 * @class Filters
 * @author Erica Salling
 * 
 * For field docs: http://keystonejs.com/docs/database/
 *
 * ==========
 */

var keystone = require('keystone');
var Types = keystone.Field.Types;
// var Filters = require('Filter');

/**
 * @module Filters
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var Filters = new keystone.List('Filter', 
    {
        hidden: false,
        // inherits: Listing,
        // nocreate: true,
        nodelete: true
    });

/**
 * Model Fields
 * @main Project
 */
Filters.add({
    name: { type: String, label: 'Name', required: true, initial: true, index: true },
    label: { type: String, label: 'ID', required: true, initial: true, index: true, note: '**must be one word no spaces - camelCaps, hy-phens, and under_scores are fine' },
    category: { type: Types.Select, label: 'Type', options: 'Institution, Discipline', required: true, initial: true, index: true }

    // filter: {
    //     type: Types.Relationship,
    //     ref: 'Syllabi',
    //     required: true,
    //     initial: true
    // }
});

/**
 * Model Registration
 * =============
 */
// Cache model in redis every .5 hr
Filters.set('redisCache', true);
Filters.set('expires', 60 * 30 * 1000);

Filters.register();

