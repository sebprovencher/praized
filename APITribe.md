# Steps to build a Praized community : API Tribe #


## Installing Wordpress ##

  * See : http://codex.wordpress.org/Installing_WordPress

## Installing the Praized Community Plugin ##

  * See : http://praizedmedia.com/en/download/wordpress

## Installing the Praized Tools Plugin ##

  * See : http://praizedmedia.com/en/download/wordpress

## Verifying apache .htaccess ##

The .htaccess configuration file from apache should be modified to support the human (and search engine) readable links that are necessary for the Praized Plugins to work. If your installation does not have the required configuration you must manually modify the .htaccess file. Ask your administrator to do it for you or you can add this configuration :

```
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
</IfModule>
```

## Configuring Praized Widgets ##

The Praized Wordpress Widgets are elements that enhance usability on your community blog. To get those to appear the same way they do on http://api-tribe.com and http://beta-tribe.com you must enable them in Wordpress's administration. Go to the Design section and Widget sub section. Praized Widget should be available there. Simply select them and reorganize to your liking by dragging and dropping them in the right section of the Widget administration tool.



---


Continue to [Our next meeting place chooser - PHP Edition](Application_Ex1.md)

Back to [Getting a user feed](GET_User_Feed.md)

Up to [Our Index](API.md)