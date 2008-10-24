=== Praized Community ===
Contributors: stephdau, sylvaincarle
Tags: location, places, merchants, api, integration, widget, social, geocode, microformat
Requires at least: 2.2
Tested up to: 2.7
Stable tag: 1.5

The Praized Community plugin allows you to deploys a complete local search
section including 17M+ North American place listings, social tools and search
functionalities through your WordPress blog. REQUIRES PHP5.



== Description ==

The Praized Community plugin allows you to deploys a complete local search
section including 17M+ North American place listings, social tools and search
functionalities through your WordPress blog.

You will need a [Praized API key](http://praizedmedia.com/en/api/) to use it.

This plugin is designed for use with the latest version of WordPress, but will
work with versions 2.2 and newer. Our plugins also support WordPress MU 1.3+.

Our plugins also currently require PHP5, though some efforts are being made to
achieve PHP4 compatibility for some features.

See also: The [Praized Tools](http://praizedmedia.com/en/download/wordpress/) plugin.



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
    - praized-community
      | license.txt
      | praized-community.php
      | readme.txt
      - includes
        - [ ... ]`

Then visit your admin area and activate the plugin and follow the onscreen
instructions.

You will need a [Praized API key](http://praizedmedia.com/en/api/) to use it.

Once you have received your API access credentials, go to the plugin's
configuration screen in "Admin -> Settings -> Praized Community" and fill in
the appropriate options with the information provided to you by Praized Media. 

**See Also:** ["Installing Plugins" on the WP Codex](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins).



== Custom Theme/Plugin/Language Integration ==

You can find our generated [phpdoc](http://phpdoc.org) documentation output
in /wp-content/plugins/praized-community/phpdocs/


###Template Development###

Definitions:
* template: Wordpress template skeleton that calls the WP headers, sidebars,
  etc, as well as the targeted Praized functionality (see fragment).
* fragment: We have separated our display logic into reusable mini-templates
  so that you can modify the templates without worrying about our functionality,
  or even embed the said fragments in your non-Praized WP templates with ease.
  Note that by convention, fragment filenames start with an underscore.

We have put a lot of efforts into making sure that the default templates
delivered with the Praized Community plugin (/wp-content/plugins/praized-community/includes/php/templates/)
works well with most WordPress themes out of the box.

For a custom look, the easiest way to customize the interface of the Praized
Community plugin output is to simply overwrite all or part of our bundled CSS
with your own, within your theme's stylesheet, by targetting our XHTML through
the namespaced id/classes parameters (id/class="praized-...").

But to allow development that extends far beyond what CSS allows for, theme
designers can also fully customize the look and feel of their Praized local
search functionality by creating their own templates or template fragments,
using our global template functions, or by even using the latter functions
and template fragments within their standard WordPress theme templates.

Before loading any of the Praized Community templates, we check if a replacement
template or template fragment exists within the currently activated theme's
directory. If one exists, we will use your template instead of our default one.

To create a custom replacement template or template fragment, simply create a
"praized-community" directory within your current theme's directory
(/wp-content/themes/your_theme/praized-community) and copy the default template
or fragment you want to overwrite into it before applying your customizations.

**EG 1**: *Your theme uses a three-columns layout, as opposed to the two-columns,
Kubrick-based one we ship by default*:

Simply copy the template files (*those not starting by an underscore [_]*) found
at the top level of /wp-content/plugins/praized-community/includes/php/templates/
to /wp-content/themes/your_theme/praized-community/ and modify the interface
skeletons as desired using the usual WP functions.

**EG 2**: *You want to customize the way we display an individual place's*:

Simply copy /wp-content/plugins/praized-community/includes/php/templates/merchant/_profile.php
to /wp-content/themes/your_theme/praized-community/merchant/_profile.php and modify
the layout as desired by using the global template functions found in
/wp-content/plugins/praized-community/includes/php/functions/.

**See also**: generated code documentation in /wp-content/plugins/praized-community/phpdocs/


###Third Party Plugins Integration###

WordPress plugins developer can also integrate with the Praized Community
functionality by using the custom global template functions found in
/wp-content/plugins/praized-community/includes/php/functions/ or by interacting
with our php classes directly (PraizedCommunity, Praized, etc).

**See also**: generated code documentation in /wp-content/plugins/praized-community/phpdocs/

With time, we are also planning to make use of the WordPress action/filter
hooks machanism to allow for even more third party integration.


###Internationalization###

The Praized Community plugin is completely translatable out of the box.

You can find the localization template you can use to translate the plugin in
/wp-content/plugins/praized-community/includes/localization.

See the [WordPress Codex](http://codex.wordpress.org/Translating_WordPress) for details.

Should you decide to take the time to translate our plugin(s) in your favorite
language before we have a chance to do so ourselves, please feel free to get
in touch with us so we can consider bundling your translation directly with
our source in future releases. http://new.praizedmedia.com/en/contact



== ChangeLog ==

**Version 1.5.1: 2008-10-24**

* Updated to praized-php-1.5.1 to implement a security in the 3rd-party Snoopy library


**Version 1.5: 2008-09-30**

* Added community-level, place-level and user-level activity stream support (Atom output
  for the said streams will be in the next release).
* Added a "default view" option in the admin to select if you want to display the
  activity stream or the top places listing by default.
* Added a "default search" option in the admin to force a query and/or location
  filter on the default place listing and searches.
* Added 16 vote button themes and an option in the admin to select your favorite one.
  You can still overwrite this in CSS by changing the background options on and
  within .praized-vote-button.
* Added links to Top Places (default place listing) an The Local Buzz (activity stream)
  in the Praized Session sidebar widget.
* Improved the overall appearance and usability of the plugin's admin/settings screen
* The Praized plugins are now officialy hosted on wordress.org and wp-plugins.org.
  This means that if you install the plugins from there, you will now be automatically
  notified whenever we release an upgrade directly in the WP admin, and other niceties.
* Fixed add/remove favorite/friend bug with MS Internet Exploder
* Updated to praized-php-1.5, whith major improvements supporting some of the new features
  implemented in this release.
* Updated to praized-wp-core-1.5, whith major improvements supporting some of the new
  features implemented in this release.


**Version 1.0.4: 2008-09-02**

* Added przd.com integration
* Added "Twitter this" functionality
* Now using the redesign "Share" functionality
* Enabled favorite and friend delete
* Updated to praized-php-1.0.4
* Updated to praized-wp-core-1.0.4


**Version 1.0.3: 2008-08-05**

* Vote button bug fix
* Updated to praized-php-1.0.3
* Updated to praized-wp-core-1.0.3


**Version 1.0.2: 2008-07-22**

* Updated URL routing handling so WP's is_404() function returns false when appropriate
* Small template bug fix for comment form when not logged in
* Updated to praized-php-1.0.2
* Updated to praized-wp-core-1.0.2


**Version 1.0.1: 2008-07-14**

* Better PHP5+ detection, with friendly message when running a lesser version
* Updated to praized-php-1.0.1 (PHP4 compat updates)
* Updated to praized-wp-core-1.0.1 (PHP4 compat updates)
* Localization updates

**Version 1.0: 2008-07-09**

* Inital release.