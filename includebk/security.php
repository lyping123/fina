<?php
if (!isset($_SESSION['id'])){
	echo "<script type='text/javascript'>
		  window.location.href = 'index.php?action=login_error'
		  </script>";
}
?>
