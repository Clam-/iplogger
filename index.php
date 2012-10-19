<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" > 
<head> 
	<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
	<title>Show IP</title> 
</head> 
<body>
<?php date_default_timezone_set('UTC'); ?>
<table border="0">
	<tr>
		<td>Current time:</td>
		<td><?php echo date(DATE_ATOM); ?></td>
	</tr>
<?php
$ipdata = file_get_contents("ip.txt");
if ($ipdata === FALSE){
	echo "<tr><td>ERROR</td></tr></table></body></html>";
	exit;
}
$lines = explode("\n", $ipdata);
foreach ($lines as $line) {
	$ipdata = explode(" - ", $line);
?>
	<tr>
		<td><?php echo $ipdata[0] ?></td>
		<td><?php echo $ipdata[1] ?></td>
	</tr>
<?php
}
?>
</table>
</body>
</html>