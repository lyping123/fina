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
?>