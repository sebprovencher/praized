#!/usr/bin/perl -w
use strict;
package PraizedTools::PraizedXHTML;

sub new {
	my($class, $data) = @_;
	my($self) = { 
		data => $data
	};

	bless($self, $class);
		
	return $self;
}

sub generate_template {
	my($self, $kind, %options) = @_;
	return 0 if $kind eq '';

	my $method = "generate_" . $kind;
	my $template_value = $self->$method($self->{data}, %options);
	
	return $template_value;
}

sub generate_badge {
	my($self, $data, %options) = @_;
	
	my $merchant 		= $data->{merchant};
	my $voteCount      = $merchant->{votes}->{count};
	my $voteCountPos   = $merchant->{votes}->{count_pos};
	my $commentCount   = $merchant->{comment_count};
	my $favoriteCount  = $merchant->{favorite_count};
	
	my $link = $self->_permalink($merchant);
	
	my $contents = "";
	eval {
		if(lc($options{subtype}) eq 'big') {
			if(defined $options{name} and lc($options{name}) eq 'true') {
				$contents .= "<a class=\"praized-merchant-inline-name\" href=\"{$link}\"><b>@{[$merchant->{name}]}</b></a>";
				$contents .= "<br />";
			}
			$contents .= <<EOS;
				<a style="text-decoration:none" class="praized-badge" id="praized-merchant-@{[$merchant->{pid}]}-badge" href="{$link}">
			      <span class="praized-badge-score">
			        <b class="praized-nominator">{$voteCountPos}</b>
			        <b class="praized-denominator">{$voteCount}</b>
			      </span>
			      <span class="praized-descriptor">
			        <span class="praized-brand">
			          PRAIZED
			        </span>
			        <span class="praized-this">
			          THIS
			        </span>
			      </span>
			    </a>
EOS

			if(defined $options{address} and lc($options{address}) eq 'true'){
		    	$contents .= "<i class=\"praized-merchant-inline-address\">@{[$merchant->{location}->{street_address}]}, @{[$merchant->{location}->{city}->{name}]}</i><br />";
			}
		
		   	if($options{phone} and lc($options{phone}) eq 'true') {
				$contents .= "<span class=\"praized-merchant-inline-phone\">@{[$merchant->{phone}]}</span><br />";
			}
		} else {
			$contents .= "<a class=\"praized-inline-merchant-container\" href=\"{$link}\">@{[$merchant->{name}]}";
			
			if(defined $options{address} and lc($options{address}) eq 'true'){
				$contents .= " (<i class=\"praized-merchant-inline-address\">@{[$merchant->{location}->{street_address}]}, @{[$merchant->{location}->{city}->{name}]}</i>) ";
			}
			
			$contents .= " <img class=\"praized-inline-merchant-arrow\" src=\"http://static.praized.com/praized-com/images/icons/up-right-green-arrow-9x9.gif\" border=\"0\" height=\"9\" width=\"9\"></span></a>";
		}	
	};
	if($@) {
		print STDERR $@;
		$contents = MT->translate("Praized: can't generate the template for: " . $merchant->{name});
	}
	return $contents;
}


# Create the permalink for the current merchant.
sub _permalink {
	my($self, $merchant) = @_;
	
	return 0 unless $merchant->{pid};
	
	my $link = ( $merchant->{permalink} ) ? $merchant->{permalink} : $self->{data}->{community}->{base_url} . "/places/" . $merchant->{pid};	
	
	$link =~ s/([^:]{1})\/\//\1\//g;
	
	return $link;
}


return 1;