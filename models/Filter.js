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

/**
 * @module Filters
 * @constructor
 * See: http://keystonejs.com/docs/database/#lists-options
 */
var Filters = new keystone.List('Filter', 
    {
        hidden: false,
        nodelete: true,
        autokey: { path: 'key', from: 'name', unique: false },
    });

/**
 * Model Fields
 * @main Project
 */
Filters.add({
    name: { type: String, label: 'Name', required: true, initial: true, index: true },
    category: { type: Types.Select, label: 'Type', options: 'Institution, Discipline', required: true, initial: true }
});

/**
 * Model Registration
 * =============
 */
Filters.defaultColumns = 'name, category';
Filters.register();

