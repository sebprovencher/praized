#!/usr/bin/perl
# $bbcode = 
package PraizedTools::Parser;
use base 'Exporter';
our @EXPORT = ('parse_bbcode', 'extract_bbcode', 'str_replace');
#
#  Extact the data from a bbcode into a machine readable hash
# '[praized permalink="1" name="chez-tycoqz" description="best resto in mtl"]';
# 
#
sub parse_bbcode {
	my ($code, %data) = @_;
	if(defined($code)) {
	if($code =~ m/^\[praized/i ) {
		while($code =~ /(\S+)=["']([^"]+)["']/g) {
			$data{$1} = $2 unless $2 eq "";
		}
		return %data;
	}
	 }
	return %data;
}

# for each block of praized blog with need 
# to generate the correct praized tags hCard and we place it into
sub extract_bbcode {
	my ($p, @data) = @_, ();
	while($p =~ /(\[praized\s.*?\])/g) {
		push(@data, $1);
	}
	return @data;
}

# How to do a search and replace in perl
# Small replace string implementation like php
sub str_replace {
	my ($search, $replace, $subject, $count) = @_;
	return -1 unless defined $subject;
	$count = -1 unless defined $count;
	my ($i,$pos) = (0, 0);
	while((my $pos = index( $subject, $search, $pos )) != -1 )	{
		substr( $subject, $pos, length($search) ) = $replace;
		$pos = $pos + length($replace);
		last if ($count > 0 && ++$i >= $count)
	}
	return $subject;
}

1;