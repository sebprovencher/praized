#!/usr/bin/perl -w

package MT::Plugin::PraizedTools;

use lib 'lib';
use strict;
use vars qw( $VERSION );
$VERSION = '1.0.3';

use PraizedTools::Modifiers;
use MT;
use MT::Request;
use base qw( MT::Plugin );

my $plugin = MT::Plugin->new({
        name => 'Praized Tools',
        description => "<MT_TRANS phrase=\"The Praized Publishing Tools will help you deploy the editorial tools to allow you to blog about places and tie everything back to your local search section.\">",
        doc_link => 'http://new.praizedmedia.com/en/download/movable-type', # Praized's tools
        author_name => 'Praized',
        author_link => 'http://praized.com/',
        version => $VERSION,
        blog_config_template => "config.tmpl",
        settings => new MT::PluginSettings([
            ['praized_api_key', { Scope => 'blog' } ],
			['praized_community_slug', { Scope => 'blog' }]
        ]),
		l10n_class => 'PraizedTools::L10N',
		registry => {
			tags => {
				modifier => {
					'praized' => \&PraizedTools::Modifiers::show_places
				}
			},
			callbacks => {
				'MT::App::CMS::template_param.edit_entry' => sub { add_praized_data_to_entry(@_); },
				'MT::App::CMS::template_source.edit_entry' => sub { add_praized_box_to_entry(@_); }
			}
		}
});

MT->add_plugin($plugin);


sub instance { $plugin }

# Add data to the current template.
sub add_praized_data_to_entry {
	my($eh, $app, $param, $tmpl) = @_;
	
	my $blog_config = $eh->plugin->get_config_hash('blog:' . $app->blog->id);
	
	$param->{praized_community_slug} = $blog_config->{praized_community_slug};
	$param->{praized_api_key} = $blog_config->{praized_api_key};
	
	# development mode
	eval {
		require PraizedTools::PraizedDev;
		my %options = PraizedTools::PraizedDev::get_development_configs();
		
		$param->{praized_searchlet_url} = $options{searchlet};
	};
	if($@){
		$param->{praized_searchlet_url} = "http://s.praized.com";
	}
}

# MT::Template::Context->add_tag(Boom => \&_ph_test);
# Valid with MT3
sub add_praized_box_to_entry_old {
	my ($eh, $app, $tmpl) = @_;
 
	# adding the configs environment to the current builder.
	$$tmpl =~ s/(<div id=\"entry-container\">)/$1<TMPL_INCLUDE NAME=\"..\/plugins\/praized-tools\/tmpl\/praized-entry-toolbar.tmpl\">/;
}

sub add_praized_box_to_entry {
    my ($cb, $app, $tmpl) = @_; 
	# adding the configs environment to the current builder.
	$$tmpl =~ s/(<div id=\"editor\">)/<TMPL_INCLUDE NAME=\"..\/plugins\/praized-tools\/tmpl\/praized-entry-toolbar.tmpl\">$1/;
}

sub load_config {
    my $plugin = shift;
    my ($param, $scope) = @_;

    $plugin->SUPER::load_config(@_);
}

1;