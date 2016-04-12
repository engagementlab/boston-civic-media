# boston-civic-media
### Setup
1. Install [EL-Website](https://github.com/engagementgamelab/EL-Website).
2. Clone this repo: `https://github.com/engagementgamelab/boston-civic-media.git`
3. Link this site to EL-Website: 

  ```
  cd boston-civic-media
  npm-link
  ```
  
  ```
  cd EL-Website
  npm link boston-civic-media
  ```
  
4. Start the site. **From EL-Website**, run:

  ```
  nodemon --debug server.js --sites=boston-civic-media
  ```
The site should now be running at http://localhost:3000.

(Better docs coming soon.)
