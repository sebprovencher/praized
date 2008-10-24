=== Praized Tools ===
Contributors: stephdau, sylvaincarle
Tags: location, places, merchants, api, integration, widget, social, geocode, microformat
Requires at least: 2.2
Tested up to: 2.7
Stable tag: 1.5

The Praized Tools plugin will enable new editorial tools within your WordPress
install for you to blog about places and tie everything back to your or a 3rd
party's Praized community.



== Description ==

The Praized Tools plugin will enable new editorial tools within your WordPress
install for you to blog about places and tie everything back to your or a 3rd
party's Praized community. It will also help you create your Praized sidebar
widget.

You will need a [Praized API key](http://praizedmedia.com/en/api/) to use it.

This plugin is designed for use with the latest version of WordPress, but will
work with versions 2.2 and newer. Our plugins also support WordPress MU 1.3+.

See also: The [Praized Community](http://praizedmedia.com/en/download/wordpress/) plugin.



== Installation ==


###Upgrading From A Previous Version###

To upgrade from a previous version of this plugin, delete the entire folder and
files from the previous version of the plugin and then follow the installation
instructions below.


###Installing The Plugin###

Extract all files from the ZIP file, making sure to keep the file structure intact,
and then upload the plugin's folder to `/wp-content/plugins/`.

This should result in something very similiar to the following file structure:

`- wp-content
  - plugins
    - praized-tools
      | license.txt
      | praized-tools.php
      | readme.txt
      - includes
        - [ ... ]`

Then visit your admin area and activate the plugin and follow the onscreen
instructions.

You will need a [Praized API key](http://praizedmedia.com/en/api/) to use it.

Once you have received your API access credentials, go to the plugin's
configuration screen in "Admin -> Settings -> Praized Tools" and fill in
the appropriate options with the information provided to you by Praized Media. 

**See Also:** ["Installing Plugins" on the WP Codex](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins).



== Using the Plugin ==

Once the plugin is installed, activated and the API credentials have been
configured, you will now see an extra button in the WordPress post and page
editor.

In visual mode (TinyMCE), the new button is a small praized icon.

In HTML mode, the new button is simply a new form button.

Clicking on the said button will launch the Praized Searchlet, a place/merchant
research tool. Once you have located the merchant you are interested in embedding
in your post/page, simply use the "Embed this place" functionality (or "Embed
this query" for search results).

Once configured to your liking, the searchlet will generate a short code, usually
known as bbcode, shortcode or markdown ([praized ...]) that will be translated to
XHTML when your post or page is viewed by your readers. You can preview how the
output will look like by using the WP post/page preview features.

You can also access the Praized Searchlet's functionality by assigning the Praized
Widget in WP Admin -> Design -> Widgets. This will allow you to feature a specific
place, or search result, in your WordPress sidebars.

If your WordPress install is already setup to use WP caching, you can turn on
caching for our embedded badges and lists through the Praized Tools admin screen.
This will speed up page rendering in high traffic site by inssuring that the
plugin does not connect to our API at each pageload, but simply refreshes the
data at your desired interval. Please note that when using advanced WP caching
plugins such as WP-Super-Cache, the said plugin's caching configuration might
take precedence over ours (TTL, static files, etc).

Developers can also find our generated [phpdoc](http://phpdoc.org)
documentation output in /wp-content/plugins/praized-tools/phpdocs/.


###Third Party Plugins/Themes Integration###

Although not as advanced as the development tools we make available with our
Praized Community plugin, we have still enabled a few basic API integration
function within the praized-tools.php plugin file.

* pzdt_merchants_get(): returns a list, as PHP object
* pzdt_merchants_search(): returns a search result, as PHP object
* pzdt_merchant_get(): returns an individual merchant/place, as PHP object
* pzdt_user_get(): returns an individual raized user, as PHP object

**See also**: generated code documentation in /wp-content/plugins/praized-tools/phpdocs/


###Internationalization###

The Praized Tools plugin is completely translatable out of the box.

You can find the localization template you can use to translate the plugin in
/wp-content/plugins/praized-tools/includes/localization.

See the [WordPress Codex](http://codex.wordpress.org/Translating_WordPress) for details.

Should you decide to take the time to translate our plugin(s) in your favorite
language before we have a chance to do so ourselves, please feel free to get
in touch with us so we can consider bundling your translation directly with
our source in future releases. http://new.praizedmedia.com/en/contact



== ChangeLog ==

**Version 1.5.1: 2008-10-24**

* Updated to praized-php-1.5.1 to implement a security in the 3rd-party Snoopy library


**Version 1.5: 2008-09-30**

* Added support for post/page level place aggregation (see admin screen)
* Added 16 vote button themes and an option in the admin to select your favorite one.
  Will use the vote button theme from Praized Community if active.
  You can still overwrite this in CSS by changing the background options on and
  within .praized-vote-button.
* Improved the overall appearance and usability of the plugin's admin/settings screen
* The Praized plugins are now officialy hosted on wordress.org and wp-plugins.org.
  This means that if you install the plugins from there, you will now be automatically
  notified whenever we release an upgradedirectly in the WP admin, and other niceties.
* Updated to praized-php-1.5, whith major improvements supporting some of the new
  features implemented in this release.
* Updated to praized-wp-core-1.5, whith major improvements supporting some of the
  new features implemented in this release.


**Version 1.0.4: 2008-09-02**

* Updated to praized-php-1.0.4
* Updated to praized-wp-core-1.0.4


**Version 1.0.3: 2008-08-05**

* New convenience button in admin to reuse the praized-community credentials if available and valid
* Updated to praized-php-1.0.3
* Updated to praized-wp-core-1.0.3


**Version 1.0.2: 2008-07-22**

* Updated to praized-php-1.0.2
* Updated to praized-wp-core-1.0.2


**Version 1.0.1: 2008-07-14**

* Better PHP4 compatibility
* Updated to praized-php-1.0.1 (PHP4 compat updates)
* Updated to praized-wp-core-1.0.1 (PHP4 compat updates)
* Localization updates


**Version 1.0: 2008-07-09**

* Inital release.