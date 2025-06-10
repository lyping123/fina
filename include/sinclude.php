<?php
require('db.php');

if($_SERVER['PHP_SELF'] != '/student_login.php'){
	require('ssecurity.php');
}elseif($_SERVER['PHP_SELF'] == '/student_login.php'){
	require('sl_security.php');
}

require('function.inc.php');

require('addon/pagination/page.php');			# page class
require('addon/pagination/pagination.php');		# page class
?>