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
	my $r_object = {};
	
	
	# config 
	my $config = MT::Plugin::PraizedTools->instance->get_config_hash('blog:' . $blog->id);
	
	# preparing for calls.
	my $api = PraizedTools::PraizedApi->new($config->{praized_api_key}, $config->{praized_community_slug});
	
	foreach my $bbcode (@data) {
		# we get an hash value to work with.
		my %places_meta_data = parse_bbcode($bbcode);
		
		my $template_name = $places_meta_data{type} || "badge";
		
		if((exists $places_meta_data{id} || exists $places_meta_data{pid}) && $template_name eq 'badge') {
			# If we dont specify the template we select the badge version
			my $identifier = $places_meta_data{id} || $places_meta_data{pid};
		
			MT->log("Praized: Fetch info for $identifier");
			# add cache support right here
			# get a single merchant object
			$r_object = $api->get_merchant($identifier);


		} elsif($template_name eq 'list') {			
			# this is a static snapshot
			my $search_params = {
				limit => $places_meta_data{limit} || 10,
				q => $places_meta_data{query}, 
				l => $places_meta_data{location},
				t => $places_meta_data{tag}
			};
				
			$r_object = $api->get_merchants($search_params);
		}	
		
		# Fetch the right template
		my $template = PraizedTools::PraizedXHTML->new($r_object);
		my $replacement = $template->generate_template($template_name, %places_meta_data);

		# We take the BBcode and make an api call to the praized's platform.
		# we need to cache the thing before going live

		$text = str_replace($bbcode, $replacement, $text);
	}
	
	
	return $text;
}

# Lookup the praized tools plugins.
sub read_config {
	my($blog_id) = @_;
	my $app = MT->instance();
}

1;