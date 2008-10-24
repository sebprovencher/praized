#
# PraizedCachedApi.pm
#
# Copyright (c) 2007 Praized Media Inc.
#
# Creation: 2008-03-26
# Author: Pier-Hugues Pellerin - ph@praizedmedia.com
#
# Small implementation of caching,
# each request to the api pass through this class.
# it use a simple hash to store the information.
#
# this class is a singleton.
# 
# $Revision:  $
# $Id:  $
# $Date:  $
use MT;
require Digest::MD5;

package PraizedTools::PraizedCachedApi;
sub new {
	my $class = shift;
	
	my $self = { 
		__cached => {},
		__api => PraizedTools::PraizedApi->new(@_)
	};
	bless($self, $class);
	return $self;
}

# Set and get a value in the cache,
# the cache is only a hash table in the memory.
sub _cache {
 my($self, $key, $value, $expiration) = @_;
 $new_key = $self->_marshal_key($key);

 if(defined $value) {
 	$self->{__cached}->{$new_key} = { value => $value, expiration => $expiration };
 } else {
	return $self->{__cached}->{$new_key}->{value};
 }
}

sub _marshal_key {
 my($self, $key) = @_;
 return Digest::MD5::md5_hex($key);
}


# We delegate the response to the api
# we cached the method name, the parameter, and we make a md5 to
# use it like a key.
sub _process {
 my $self = shift;
 my $command = shift;

 $command =~ s/.*://;

 # we need to keep track of the params,
 # and generate a unique identifier for them. 
 my $str = join("-", @_);

 my $key = $command . ":" . $str;
 my $data = $self->_cache($key);
 if($data) {
	return $data;
 } else {
	$data = $self->{__api}->$command(@_);
	$self->_cache($key, $data);
	return $data;
 }

}

# this is like ruby's method missing
sub AUTOLOAD {
 my $self = shift;
 my $command = our $AUTOLOAD;
 
 return $self->_process($command, @_);
}

sub DESTROY {}

1;