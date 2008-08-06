#
# Modifiers.pm
#
# Copyright (c) 2007 Praized Media Inc.
#
# Creation: 2008-03-21
# Author: Pier-Hugues Pellerin - ph@praizedmedia.com
#
# Parse each entries when you publish your blog
# It will look for bbcode, extact the data into an hash, push it into
# a predefined template and replace the bbcode with the praized's
# microformat. The original entry in the database will not be touched.
# 
#
# $Revision:  $
# $Id:  $
# $Date:  $

package PraizedTools::Modifiers;
use strict;
use MT::Plugin;
use MT::Request;
use JSON;
use PraizedTools::Parser;
use PraizedTools::PraizedApi;
use PraizedTools::PraizedCachedApi;
use PraizedTools::PraizedXHTML;

# This is called by the praizedtools modifier on the MTEntry tags,
# we are making a call to the praized's platform to get the appropriate
# html fragment
sub show_places {
	my ($text, $attr, $ctx) = @_;
	return $text unless $attr eq "1";
	
	# extract all the bbcodes
	my $blog = $ctx->stash('blog');
	my @data =  extract_bbcode($text);
	
	# config 
	my $config = MT::Plugin::PraizedTools->instance->get_config_hash('blog:' . $blog->id);
	
	# preparing for calls.
	my $api = PraizedTools::PraizedApi->new($config->{praized_api_key}, $config->{praized_community_slug});
	
	foreach my $bbcode (@data) {
		# we get an hash value to work with.
		my %places_meta_data = parse_bbcode($bbcode);
		
		if(exists $places_meta_data{id} || exists $places_meta_data{pid}) {
			my $identifier = $places_meta_data{id} || $places_meta_data{pid};
			MT->log("Praized: Fetch info for $identifier");

			# If we dont specify the template we select the badge version
			my $template_name = $places_meta_data{type} || "badge";
		
			# add cache support right here
			my $r_object = $api->get_merchant($identifier);
		
		
			# Fetch the right template
			my $template = PraizedTools::PraizedXHTML->new($r_object);
			my $replacement = $template->generate_template($template_name, %places_meta_data);
		
			# We take the BBcode and make an api call to the praized's platform.
			# we need to cache the thing before going live
			$text = str_replace($bbcode, $replacement, $text);
		}
	}
	return $text;
}

# Lookup the praized tools plugins.
sub read_config {
	my($blog_id) = @_;
	my $app = MT->instance();
}

1;