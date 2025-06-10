<?php
require('db.php');

if($_SERVER['PHP_SELF'] != '/lastersturegistration/index.php'){
	require('security.php');
}elseif($_SERVER['PHP_SELF'] == '/lastersturegistration/index.php'){
	require('l_security.php');
}

require('function.inc.php');

require('addon/pagination/page.php');			# page class
require('addon/pagination/pagination.php');		# page class
?>