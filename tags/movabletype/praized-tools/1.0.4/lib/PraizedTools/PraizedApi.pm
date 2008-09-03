#!/usr/bin/perl -w
use strict;
use Net::HTTP;
use LWP::UserAgent;
use HTTP::Request;
use URI;
use URI::QueryParam;
use MT;
#use LWP::Debug qw(+);

package PraizedTools::PraizedApi;
sub new {
	my($class, $api_key, $community_permalink, $format) = @_;
	my($self) = { 
		api_key => $api_key, 
		community_permalink => $community_permalink,
		api => "http://api.praized.com",
		praized_agent => "Praized PERL client v0.1",
		format => lc($format) || "json",
	};

	# This is for development purposes
	eval {
		require PraizedTools::PraizedDev;
		
		my %options = PraizedTools::PraizedDev::get_development_configs();

		$self->{api} = $options{api};
	};

	
	bless($self, $class);
	
	$self->create_http();
	
	return $self;
}

sub create_http {
	my($self) = shift;	
	$self->{ua} = LWP::UserAgent->new(
										env_proxy => 1,
										keep_alive => 1,
										timeout => 30,
										agent => $self->{praized_agent}
										); 
}

sub get_merchant {
	my $self = shift;
	my $permalink = shift;
	my $params = shift;
	
	return $self->make_call("merchants/$permalink", $params);
}

sub get_merchants {
	my $self = shift;
	my $params = shift;
	
	return $self->make_call('merchants', $params);
}


sub make_call {
	my ($self, $action_link, $params) = @_;
	
	my $url = $self->{api} . "/" . $self->{community_permalink} . "/" . $action_link . ".". $self->{format};
	
	# Create the resource and add get parameters.
	my $resource = URI->new($url);
		
	$resource->query_param_append("api_key", $self->{api_key});
	$resource->query_param_append('q', $params->{q}) if defined $params->{q};
	$resource->query_param_append('l', $params->{l}) if defined $params->{l};
	$resource->query_param_append('t', $params->{t}) if defined $params->{t};
	$resource->query_param_append('limit', $params->{limit}) if defined $params->{limit};
	
	#printf ("Query to send. " . $resource->query);
	my $request = HTTP::Request->new('GET', $resource);
	$request->authorization_basic($self->{praized_user}, $self->{praized_password});

	my $response = $self->{ua}->request($request);
	
	return $self->transform_response($response->{_content});
}


sub transform_response {
	my($self, $raw) = @_;
	
	
	if($self->{format} eq "json") {
		require JSON;
		my $value = JSON::jsonToObj($raw);
		
		return $value->{praized};
	}
	return $raw;
}

1;