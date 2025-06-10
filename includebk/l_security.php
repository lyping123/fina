<?php
if (isset($_SESSION['id'])){
	echo "<script type='text/javascript'>
		  window.location.href = '../lastersturegistration/student_list.php'
		  </script>";
}
?>
