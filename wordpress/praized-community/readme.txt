=== Praized Community ===
Contributors: stephdau, sylvaincarle
Tags: location, places, merchants, api, integration, widget, social, geocode, microformats, microformat, oauth
Requires at least: 2.2
Tested up to: 2.7
Stable tag: trunk

The Praized Community plugin allows you to deploys a complete local search
section including 17M+ North American place listings, social tools and search
functionalities through your WordPress blog. REQUIRES PHP5.



== Description ==

The Praized Community plugin allows you to deploys a complete local search
section including 17M+ North American place listings, social tools and search
functionalities through your WordPress blog (see screenshots).

**You will need a [Praized API key](http://praizedmedia.com/en/api/) to use it.**

This plugin is designed for use with the latest version of WordPress, but will
work with versions 2.2 and newer. Our plugins also support WordPress MU 1.3+.

**Please note that the Praized Community plugin requires PHP5**.

**See also**: The companion [Praized Tools](http://wordpress.org/extend/plugins/praized-tools/) plugin (PHP4 compatible).



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
the appropriate options with the information provided to you by Praized Media
when you [request access to our API](http://praizedmedia.com/en/api/). 

**See Also:** ["Installing Plugins" on the WP Codex](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins).



== Screenshots ==

1. Top Places (highest rated) for the deployed community.
2. The Local Buzz (activity stream) for the deployed community.
3. Single place details screen, with microformats, Google Maps integration, etc.
4. Sample user profile page.
5. Plugin administration screen. **Note**: API credentials seen in the picture won't work. You need to [get your own](http://praizedmedia.com/en/api/). :)



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

The Praized Community plugin is completely translatable out of the box and comes
with English and French bundles by default..

You can find the localization template you can use to translate the plugin in
/wp-content/plugins/praized-community/includes/localization.

See the [WordPress Codex](http://codex.wordpress.org/Translating_WordPress) for details.

Should you decide to take the time to translate our plugin(s) in your favorite
language before we have a chance to do so ourselves, please feel free to get
in touch with us so we can consider bundling your translation directly with
our source in future releases. http://new.praizedmedia.com/en/contact



== ChangeLog ==


Version 2.0.1: 2009-06-26

* Updated to praized-php-2.0.1.


Version 2.0: 2009-04-29

* Implemented a less intrusive (lightbox-based, optional) authorization process so that users do not
  completely leave your site to connect your community to their Praized account (see plugin's
  config screen to enable/disable).
* Now supporting Facebook Connect to login to the Praized Network when using the new lightbox
  login (see above). Will also be available in the standard login flow shortly.
* Implemented the concept of "display name" where appropriate, for people such as Facebook Connect
  users with non-friendly praized login name.
* Implemented full user account management functionalities so people can update their Praized account
  information (password, avatar, social media broadcast settings, etc) right from within your pages,
  without ever leaving your site.
* Upgraded the interface of the place and user profiles as a tabbed interface (activity, votes,
  favorites, comments, etc). SEO or accessibility will no be affected, since the information is still
  all in the page. The screen is simply reformatted on the fly via css and javascript.
* Added geo meta and RDF tags to single merchant views for increased semantic and SEO value.
* Plugin now comes bundled with full French translation if running WordPress in French.
* And many more misc improvements and performance tweaks.
* Updated to praized-php-2.0.
* Updated to praized-wp-core-2.0.


Version 1.7: 2009-01-12

* Added search form to the top of most of the praized templates, as appropriate.
* Modified the search form widget so that it is automatically hidden when the same form is shown in
  the main content area (see above).
* Implemented a new search results header which mentions the number of results found.
* Extracted the main section links (Top Places, The Local Buzz and Questions & Answers) from the Praized
  Session widget and created a stand-alone Praized Section widget as a navigation only tool.  
* Exposed the place tagging and commenting functionalities for non-logged in users and made it so that
  the submitted data (tags, comment) is preserved and processed at the end of the login process if
  required (like we've done for votes and such in v1.6).
* Added a new help section for the Praized functionalities. Note that the content we display in this page
  is actually stored on our server (but cached on yours), so you will get any updates we make automatically
  as we release them. 
* Added an upgrade notification mechanism so you don't miss out on important new changes when upgrading to a new version of the plugin.
* Added suport for the Praized sponsored images in the sponsored links block.
* Updated to praized-php-1.7.
* Updated to praized-wp-core-1.7.


Version 1.6: 2008-12-05

* Implemented Questions & Answers features!
* Added the ability to select the Questions & Answers section as the default page for your Praized
  Community (see plugin config screen)
* Place/Merchant tags are now routed as */category/* for (supposedly) better search engine indexing.
  Both */category/* and */tag/* are supported.
* If a user tries to vote, post a question or post an answer while not logged in to the Praized Network,
  their action is now processed after they sign in.
  EG: vote while logged out -> redirect login + authorize -> back to merchant -> vote is counted
* Added user avatar support where appropriate (user profile, comments, etc).
* Now supporting Google Maps up to 640x640px (from a previous max of 512x512px).
* Updated to praized-php-1.6 to implement the new place resolver API methods.
* Updated to praized-wp-core-1.6 to implement the new place resolver API methods.


Version 1.5.1: 2008-10-24

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