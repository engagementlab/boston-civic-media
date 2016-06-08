/*!
 * Engagement Lab Site Framework
 * Developed by Engagement Lab, 2016
 * ==============
*/

 /**
 * Database backup/restore task. Backup should be run nightly as cron task via 'grunt backupdata'. Backup is also copied to another server.
 * 
 * ### Examples:
 *
 *    // Runs backup nightly
 *    0 23 * * * /srv/website/grunt backupdata >/dev/null 2>&1
 *
 *
 * @class Grunt
 * @name grunt/news
 */
 module.exports = {

  options: {
    host: 'catan.dev.emerson.edu',
    port: '27017',
    db: 'boston-civic-media'
  },

  restore: {
    task: 'restore',
    path: './dump/boston-civic-media',
    db: 'boston-civic-media',
    drop: true
  },

  dump: {
      out: './dump/daily_bk/'
  }

};
