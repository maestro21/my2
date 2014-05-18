Maestro Engine v2
===
Maestro Engine v2 is the version of engine I am currently developing starting from 2012 and using for my own purpose. I have developed lots of modules based on this version including:
* Blogs
* Links
* Image gallery
* Video
* Forum  
It also allows to parse URL via API. Use following script for it:
```js
javascript:(function(){ var i = document.createElement("img"); var tags = prompt("Enter tags"); i.src = "http://YOURSITE/api_save.php?url="+encodeURIComponent(location.href) + "&tags="+tags; })();
```
Please note that it is my current working repository so code is not smooth and may contain commented elements and is pretty messy. If you want to check my 'demo' code, please have a look at v1 and Bookster

Installation:
---
1. Download this repository
2. Create database and execute db/schema.sql
3. Set up your website and database settings in sqlconf.php in root directory
4. Go to your website and log in via password 'admin'
5. Work

Difference from v1
-----
Although it doesn't have significant difference from v1, it still has some:
* instead of two huge administration parts it has small administration line on top of the site
* ajax.php was created for handling AJAX requests
* some useful functions has been implemented like Loadmodule
* ckeditor is used instead of edit_area
* 'classes' folder is renamed to 'modules'
 
For detailed description of V1 please refer 'engine' repository.
