<?php
if (!isset($_SESSION['id'])){
	echo "<script type='text/javascript'>
		  window.location.href = 'student_login.php?action=login_error'
		  </script>";
}
?>
