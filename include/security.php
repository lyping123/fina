<?php
if (!isset($_SESSION['id'])){
	echo "<script type='text/javascript'>
		  window.location.href = 'index.php?action=login_error'
		  </script>";
}


if (isset($_SESSION['level']) && $_SESSION['level'] == 'student'){
	echo "<script type='text/javascript'>
		  window.location.href = '../student_break.php'
		  </script>";
}
?>
