<?php

date_default_timezone_set('UTC');

// parse_ipve($_SERVER['REMOTE_ADDR']);
function parse_ipv4($addr)
{
	// http://stackoverflow.com/questions/12435582/php-serverremote-addr-shows-ipv6
	// Known prefix
	$v4mapped_prefix_hex = '00000000000000000000ffff';
	$v4mapped_prefix_bin = pack("H*", $v4mapped_prefix_hex);
	// Or more readable when using PHP >= 5.4
	//$v4mapped_prefix_bin = hex2bin($v4mapped_prefix_hex); 

	// Parse
	//$addr = $_SERVER['REMOTE_ADDR'];
	$addr_bin = inet_pton($addr);
	if( $addr_bin === FALSE ) {
	  // Unparsable? How did they connect?!?
	  die('Invalid IP address');
	}

	// Check prefix
	if( substr($addr_bin, 0, strlen($v4mapped_prefix_bin)) == $v4mapped_prefix_bin) {
	  // Strip prefix
	  $addr_bin = substr($addr_bin, strlen($v4mapped_prefix_bin));
	}

	// Convert back to printable address in canonical form
	$addr = inet_ntop($addr_bin);
	return $addr;
}

//$_SERVER['REMOTE_ADDR']
//"::ffff:118.209.6.192"
$newip = parse_ipv4($_SERVER['REMOTE_ADDR']);

$newline = $newip . " - " . date("Ymd-H:i:s") . "\n";

$old = file_get_contents("ip.txt");

if ($old === FALSE){
	echo 1;
	exit;
}
if ($old == "")
{
	if (file_put_contents("ip.txt", $newline) === FALSE) {
	
	}
	else {
		echo 0;
		exit;
	}
}

$oldlines = explode("\n", $old);
$olddata = explode(" - ", $oldlines[0]);
$oldip = $olddata[0];

if ($oldip != $newip) {
	$new = $newline . $oldlines[0];
}
else {
	$new = $newline . $oldlines[1];
}
if (file_put_contents("ip.txt", $new) === FALSE)
{
	echo 1;
}
else
	echo 0;
?>