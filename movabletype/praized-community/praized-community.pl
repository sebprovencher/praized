#!/usr/bin/perl -w
use strict;
use MT;

use vars qw( $VERSION );
$VERSION = '1.0.3';

my $plugin;
eval {
    require MT::Plugin;
    $plugin = MT::Plugin->new({
        name => 'Praized Community',
        description => "<MT_TRANS phrase=\"The Praized Community plugin will help you deploy your blog's complete local search functionality (search, North American data and social tools).\">",
        doc_link => 'http://new.praizedmedia.com/en/download/movable-type', # Praized's tools
        author_name => 'Praized',
        author_link => 'http://praized.com/',
        version => $VERSION,
        config_template => "config.tmpl",
        settings => new MT::PluginSettings([
            			['praized_api_key', { Scope => 'blog' } ],
						['praized_community_slug', { Scope => 'blog' }],
						['praized_consumer_key', { Scope => 'blog' }],
						['praized_consumer_secret', { Scope => 'blog' }],
						['praized_trigger', { Scope => 'blog',
											  Default => '/'
											}],
						['praized_google_maps_api_key', { Scope => 'blog' }],
						['praized_google_maps_width', { Scope => 'blog' }],
						['praized_google_maps_height', { Scope => 'blog' }],
						['praized_google_maps_zoom_level', { Scope => 'blog' }]
        ]),
		# All available MT tags, we need to define them in perl
		# to make them valid in the admin window, 
		# did i broke the window height?
		#
		# Yes most of theses templates come from the _classic_ mt layout for now
		registry => {
			# callbacks.
			# When a template is selected or switched to the Praized Community
			# we need to install the new mtview.php, install the htaccess file
			# and changed the blog default configuration for publishing.
			callbacks => {
				"blog_template_set_change" => sub { _hdlr_on_template_set_change(@_) }
			},
			template_sets => {
				praized_community_set => {
						label => 'Praized Community',
						base_path => 'tmpl/templates_classic',
						order => 1000,
						templates => {
							# Most of the praized's 
							# index templates.
							'index' => {
								# Classic MT blog
								'archive_index' => { label => 'Archive Index', outfile => 'archives.html', build_dynamic => '1' },
								'atom' => { label => 'Atom', outfile => 'atom.xml', build_dynamic => '1' },
								'javascript' => { label => 'JavaScript', outfile => 'mt.js', build_dynamic => '1' },
								'main_index' => { label => 'Main Index', outfile => 'index.html', build_dynamic => '1' },
								'rsd' => { label => 'RSD', outfile => 'rsd.xml', rebuild_me => '1', build_dynamic => '1' },
								'rss' => { label => 'RSS', outfile => 'rss.xml', rebuild_me => '1', build_dynamic => '1' },
								'stylesheet' => { label => 'Stylesheet', outfile => 'styles.css', build_dynamic => '1' },
								
								# Praized specific templates
								#'mtview' => { label => 'Praized Site Bootstrapper', outfile => 'mtview.php', rebuild_me => '1', build_dynamic => 1 },
								'merchant' => { label => 'merchant', outfile => 'praized_merchant.html',  rebuild_me => '1', build_dynamic => '1' },
								'merchants' => { label => 'merchants', outfile => 'praized_merchants.html', rebuild_me => '1', build_dynamic => '1' },
								'taggings' => { label => 'taggings', outfile => 'praized_taggings.html', rebuild_me => '1', build_dynamic => '1' },
								'users' => { label => 'users', outfile => 'praized_users.html', rebuild_me => '1', build_dynamic => '1' },
								'users_comments' => { label => 'users_comments', outfile => 'praized_users_comments.html', rebuild_me => '1', build_dynamic => '1' },
								'users_favorites' => { label => 'users_favorites', outfile => 'praized_users_favorites.html', rebuild_me => '1', build_dynamic => '1' },
								'users_friends' => { label => 'users_friends', outfile => 'praized_users_friends.html', rebuild_me => '1', build_dynamic => '1' },
								'users_votes' => { label => 'users_votes', outfile => 'praized_users_votes.html', rebuild_me => '1', build_dynamic => '1' },
								'merchants_comments' => { label => 'merchants_comments', outfile => 'praized_merchants_comments.html', rebuild_me => '1', build_dynamic => '1' },
								'merchants_favorites' => { label => 'merchants_favorites', outfile => 'praized_merchants_favorites.html', rebuild_me => '1', build_dynamic => '1' },
								'merchants_votes' => { label => 'merchants_votes', outfile => 'praized_merchants_votes.html', rebuild_me => '1', build_dynamic => '1' },
							},
							'individual' => {
								# Classic MT Blog
								'entry' => { 
									label => 'entry', 
									build_dynamic => '1',
									mappings => { 
										entry_archive => { 
											archive_type => 'Individual'
										}
									}
								},
							},
					        'page' => {
					            'page' => {
					                label => 'Page',
									build_dynamic => '1',
					                mappings => {
					                    page_archive => {
					                        archive_type => 'Page',
					                    },
					                },
					            },
					        },
							'archive' => {
								# Classic MT Blog
								entry_listing => { 
									label => 'Entry Listing',
									build_dynamic => '1',
									mappings => {
										monthly => {
											archive_type => 'Monthly'
										},
										category_monthly => {
											archive_type => 'Category-Monthly'
										},
										author_monthly => {
											archive_type => 'Author-Monthly'
										},
										category => {
											archive_type => 'Category'
										}
									}
								}
							},
							'system' => { 
								# Classic MT Blog
								'comment_preview' => { 
									label => 'Comment Preview',
									rebuild_me => '1',
									description_label => '<MT_TRANS phrase="Displays preview of comment.">'
								},
								'comment_response' => { 
									label => 'Comment Response', 
									rebuild_me => '1',
									description_label => '<MT_TRANS phrase="Displays error, pending or confirmation message for comments.">'
								}, 
								'dynamic_error' => { 
									label => 'Dynamic Error', 
									rebuild_me => '1',
									description_label => '<MT_TRANS phrase="Displays errors for dynamically published templates.">'
								},
								'popup_image' => { 
									label => 'Popup image', 
									rebuild_me => '1',
									description_label => '<MT_TRANS phrase="Displays results of a search.">'
								},
								'search_results' => { 
									label => 'Search Results', 
									rebuild_me => '1',
									description_label => '<MT_TRANS phrase="Displays image when user clicks a popup-linked image.">'
								}
								# TODO Missing Entry Response?
							},
							'module' => {
								# Classic MT Blog
								'categories' => { label => 'Categories' },
								'comment_detail' => { label => 'Comment Detail' },
								'comment_form' => { label => 'Comment Form' },
								'comments' => { label => 'Comments' },
								'entry_detail' => { label => 'Entry Detail' }, 
								'entry_metadata' => { label => 'Entry Metadata' }, 
								'entry_summary' => { label => 'Entry Summary' },
								'footer' => { label => 'Footer' },
								'header' => { label => 'Header' },
								'page_detail' => { label => 'Page Detail' },
								'sidebar_-_2_column_layout' => { label => 'Sidebar' },
								'sidebar_-_3_column_layout' => { label => 'Sidebar' },
								'tags' => { label => 'Tags' },
								'trackbacks' => { label => 'TrackBacks' },
								# Praized specific templates
								'searchbox' => { label => 'Searchbox' },
								'merchant-hcard' => { label => 'praized-merchant-hcard' },
								'user-hcard' => { label => 'praized-user-hcard' }
							}
						}
					}
			},
			tags => {
				function => {
#<PRAIZED_MT_FUNCTIONS>
					"praizedcredits" => \&_hdlr_doesnt_do_anything,
					"praizedcurrentuserlogin" => \&_hdlr_doesnt_do_anything,
					"praizedgooglemapsapikey" => \&_hdlr_doesnt_do_anything,
					"praizedhubaddplacelink" => \&_hdlr_doesnt_do_anything,
					"praizedhubcommunitieslink" => \&_hdlr_doesnt_do_anything,
					"praizedhubuserprofilelink" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantbusinesshours" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantcity" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantcitycode" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantcommentbody" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantcommentdate" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantcommentscount" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantcountry" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantcountrycode" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantcreatedat" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantdescription" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantemail" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantfavoritescount" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantfax" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantlatitude" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantlongitude" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantmap" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantname" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantpermalink" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantphone" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantpid" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantpostalcode" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantregions" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantselffavorite" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantselfrating" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantshare" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantspagination" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantsponsoredlinkslabel" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantsponsoredlinksorder" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantsponsoredlinksurl" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantstatsimg" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantstreetaddress" => \&_hdlr_doesnt_do_anything,
					"praizedmerchanttagcount" => \&_hdlr_doesnt_do_anything,
					"praizedmerchanttaglink" => \&_hdlr_doesnt_do_anything,
					"praizedmerchanttagname" => \&_hdlr_doesnt_do_anything,
					"praizedmerchanttargetfavorite" => \&_hdlr_doesnt_do_anything,
					"praizedmerchanttargetrating" => \&_hdlr_doesnt_do_anything,
					"praizedmerchanturl" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantvotescount" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantvotesnegcount" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantvotesposcount" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantvotesrating" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantvotesscore" => \&_hdlr_doesnt_do_anything,
					"praizedpagination" => \&_hdlr_doesnt_do_anything,
					"praizedsearchlocation" => \&_hdlr_doesnt_do_anything,
					"praizedsearchquery" => \&_hdlr_doesnt_do_anything,
					"praizedsearchtag" => \&_hdlr_doesnt_do_anything,
					"praizedsearchterms" => \&_hdlr_doesnt_do_anything,
					"praizedseotitle" => \&_hdlr_doesnt_do_anything,
					"praizeduserabout" => \&_hdlr_doesnt_do_anything,
					"praizeduserclaimtofame" => \&_hdlr_doesnt_do_anything,
					"praizedusercommentcount" => \&_hdlr_doesnt_do_anything,
					"praizedusercreatedat" => \&_hdlr_doesnt_do_anything,
					"praizeduserdateofbirth" => \&_hdlr_doesnt_do_anything,
					"praizeduseremail" => \&_hdlr_doesnt_do_anything,
					"praizeduserfavoritecount" => \&_hdlr_doesnt_do_anything,
					"praizeduserfirstname" => \&_hdlr_doesnt_do_anything,
					"praizeduserfriendcount" => \&_hdlr_doesnt_do_anything,
					"praizedusergender" => \&_hdlr_doesnt_do_anything,
					"praizeduserlastname" => \&_hdlr_doesnt_do_anything,
					"praizeduserlogin" => \&_hdlr_doesnt_do_anything,
					"praizeduserpermalink" => \&_hdlr_doesnt_do_anything,
					"praizeduservotecount" => \&_hdlr_doesnt_do_anything,
#</PRAIZED_MT_FUNCTIONS>








				},
				block => {
#<PRAIZED_MT_BLOCKS>
					"ifpraizedcurrentuser" => \&_hdlr_doesnt_do_anything,
					"ifpraizedhasnextmerchant" => \&_hdlr_doesnt_do_anything,
					"ifpraizedhasnextmerchantcomment" => \&_hdlr_doesnt_do_anything,
					"ifpraizedhasnextmerchantfavorer" => \&_hdlr_doesnt_do_anything,
					"ifpraizedhasnextmerchantpraizer" => \&_hdlr_doesnt_do_anything,
					"ifpraizedhasnextmerchantsponsoredlink" => \&_hdlr_doesnt_do_anything,
					"ifpraizedhasnextmerchanttag" => \&_hdlr_doesnt_do_anything,
					"ifpraizedhasnextusercomment" => \&_hdlr_doesnt_do_anything,
					"ifpraizedhasnextuserfavorite" => \&_hdlr_doesnt_do_anything,
					"ifpraizedhasnextuserfriend" => \&_hdlr_doesnt_do_anything,
					"ifpraizedhasnextuservote" => \&_hdlr_doesnt_do_anything,
					"ifpraizedmerchantfavorited" => \&_hdlr_doesnt_do_anything,
					"ifpraizedmerchanthassponsorlinks" => \&_hdlr_doesnt_do_anything,
					"ifpraizedmerchants" => \&_hdlr_doesnt_do_anything,
					"ifpraizedmerchanttags" => \&_hdlr_doesnt_do_anything,
					"ifpraizeduserisauthorized" => \&_hdlr_doesnt_do_anything,
					"ifpraizeduserisfriend" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantcomments" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantfavorers" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantpraizers" => \&_hdlr_doesnt_do_anything,
					"praizedmerchants" => \&_hdlr_doesnt_do_anything,
					"praizedmerchantsponsoredlinks" => \&_hdlr_doesnt_do_anything,
					"praizedmerchanttags" => \&_hdlr_doesnt_do_anything,
					"praizednosearchresults" => \&_hdlr_doesnt_do_anything,
					"praizedsearchresults" => \&_hdlr_doesnt_do_anything,
					"praizedusercomments" => \&_hdlr_doesnt_do_anything,
					"praizeduserfavorites" => \&_hdlr_doesnt_do_anything,
					"praizeduserfriends" => \&_hdlr_doesnt_do_anything,
					"praizeduservotes" => \&_hdlr_doesnt_do_anything,
#</PRAIZED_MT_BLOCKS>








				}
			}
		}
    });
    MT->add_plugin($plugin);
};


# TODO move theses method in their own namespace.
# We change some default config.

# Fired when a template is changed.
sub _hdlr_on_template_set_change {
	my ($cb, $param) = @_;
	
	return 1 if 'praized_community_set' ne $param->{blog}->template_set;
	MT->log("Praized Community, modifying the default configuration for: " . $param->{blog}->name . " using template set '" . $param->{blog}->template_set . "'");
	
	# we need to set up dynamic publishing for all templates.
	# blog_is_dynamic
	# blog_custom_dynamic_templates
	my $blog = $param->{blog};
	$blog->custom_dynamic_templates('all');
	$blog->save();
	
	create_htaccess($blog, $blog->site_path, $blog->site_url);
	create_praizedmtview($blog, $blog->site_path, $blog->site_url);
	create_first_post($blog);
	
	# Templates_c
	my $compiled_template_path = 
		File::Spec->catfile( $blog->site_path, 'templates_c' );
	$blog->file_mgr->mkpath($compiled_template_path) || die("Can't create the directory: " . $compiled_template_path);
	
	return 1;
}

# Create a Dummy post to the community to bootstrap the user
sub create_first_post {
	my ($blog) = @_;

	require MT::Entry;
	
	# Creating post if the entry table is empty
 	if(MT::Entry->count({ blog_id => $blog->id }) eq 0) {

		MT->log("Praized Community: creating the welcome post.");
	
		my $title = MT->translate("Welcome to my new community");
		my $body  = MT->translate("This is a simple post you can delete it, if you want.");
	
		my $entry = MT::Entry->new;
		$entry->blog_id($blog->id);
		$entry->status(MT::Entry::RELEASE());
		$entry->title($title);
		$entry->author_id(MT->instance->{author}->id);
		$entry->text($body);
		$entry->save or die $entry->errstr;
	}
	
	# rebuild the links
	# Create the corresponding file structure
	use MT::WeblogPublisher;
	my $pub = MT::WeblogPublisher->new;
	$pub->rebuild(Blog => $blog, ArchiveType => "Individual");
}

# We read the initial template and generate the default view
# this is the mt normal behavior on dynamic publishing.
sub create_praizedmtview {
	my ($blog, $site_path, $site_url) = @_;
	
	MT->log("Praized Community: creating praized mt view.");
	
	my $mtview_path = File::Spec->catfile( $site_path, 'mtview.php' );
	
	# we grep the cgi path
	my $cgi_path    = MT->instance->server_path() || "";
	$cgi_path =~ s!/*$!!;
	
	# we use the cgi path to build dependencies to the php lib.
	my $mt_php_path			= File::Spec->canonpath("$cgi_path/php/mt.php");
	my $mt_praized_php_path = File::Spec->canonpath("$cgi_path/plugins/praized-community/php/PraizedViewer.php");
	my $mt_config		    = MT->instance->{cfg_file};
	my $blog_id				= $blog->id;
	
	eval {
		my $contents = <<VIEW_CONTENT;
<?php
include_once '$mt_php_path';
include_once '$mt_praized_php_path';
\$mt = new PraizedViewer($blog_id, '$mt_config');
\$mt->view();
?>
VIEW_CONTENT

		$blog->file_mgr->mkpath($site_path) || die("Can't create the directory: " . $site_path);
	
	
		# Save the MTView
		# mtview.php will be added to the blog templates.
		open(my $mt_view_content, ">$mtview_path") || die("Can't open file $mtview_path for writing.");
			print $mt_view_content $contents || die("You don't have the permission to write to $mtview_path.");
		close $mt_view_content;
	};
	if ($@) { print STDERR $@; }
}

# TODO, Anyone is using windows for this?
# Extract from CMS.pm of the MT install.
# We use the same technic to publish the praized platform.
sub create_htaccess {
	my ($blog, $site_path, $site_url) = @_;
	
	MT->log("Praized Community: creating htaccess.");


	my $htaccess_path = File::Spec->catfile( $site_path, '.htaccess' );
	my $mtview_path   = File::Spec->catfile( $site_path, 'mtview.php' );
	
	return 1 if(( -f $htaccess_path ) &&  ( -f $mtview_path ));
	
	# We use the URI to map the mtview.php in the htaccess
	require URI;
	my $mtview_uri_obj = new URI($site_url);
	my $mtview_server_url = $mtview_uri_obj->path();
	
	#merge with the mtview template.
	$mtview_server_url .= ($mtview_server_url =~ /\/$/ ? '' : '/') . "mtview.php";
	
	
	# This is the same HTACCESS from the MT initial installation.	
	my $htaccess = <<HTACCESS;
## %%%%%%% Movable Type generated this part; don't remove this line! %%%%%%%
# Disable fancy indexes, so mtview.php gets a chance...
Options -Indexes +SymLinksIfOwnerMatch
<IfModule mod_rewrite.c>
# The mod_rewrite solution is the preferred way to invoke
# dynamic pages, because of its flexibility.

# Add mtview.php to the list of DirectoryIndex options, listing it last,
# so it is invoked only if the common choices aren't present...
<IfModule mod_dir.c>
DirectoryIndex index.php index.html index.htm default.htm default.html default.asp $mtview_server_url
</IfModule>

RewriteEngine on

# don't serve mtview.php if the request is for a real directory
# (allows the DirectoryIndex lookup to function)
RewriteCond %{REQUEST_FILENAME} !-d

# don't serve mtview.php if the request is for a real file
# (allows the actual file to be served)
RewriteCond %{REQUEST_FILENAME} !-f
# anything else is handed to mtview.php for resolution
RewriteRule ^(.*)\$ $mtview_server_url [L,QSA]
</IfModule>

<IfModule !mod_rewrite.c>
# if mod_rewrite is unavailable, we forward any missing page
# or unresolved directory index requests to mtview
# if mtview.php can resolve the request, it returns a 200
# result code which prevents any 4xx error code from going
# to the server's access logs. However, an error will be
# reported in the error log file. If this is your only choice,
# and you want to suppress these messages, adding a "LogLevel crit"
# directive within your VirtualHost or root configuration for
# Apache will turn them off.
ErrorDocument 404 $mtview_server_url
ErrorDocument 403 $mtview_server_url
</IfModule>
## ******* Movable Type generated this part; don't remove this line! *******
HTACCESS

	# make default path
	$blog->file_mgr->mkpath($site_path) || die("Can't create the directory: " . $site_path);
	
	open( HT, ">>$htaccess_path" ) || die("Can't open the file $htaccess_path");
	   print HT $htaccess || die("You don't have the permission to write to $htaccess_path");
	close HT;
}


# defining placebos functions
# our plugin only support dynamic plublishing
sub _hdlr_doesnt_do_anything { 
	my ($ctx, $args, $cond) = @_;
	return "Praized's plugin only support dynamic publishing with PHP templates."; 
}

1;