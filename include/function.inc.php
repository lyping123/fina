<?php
function systemMsg($type, $title, $msg)
{
	$msg = "<div class='row'>
			<div class=\"alert $type\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				<strong>$title</strong> $msg
			</div></div>";
	return $msg;
}
function clean($string) {
   $string = str_replace('-', '', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
?>