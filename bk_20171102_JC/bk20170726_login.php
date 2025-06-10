<?php
require('include/db.php');

if(isset($_POST['submit']) && $_POST['submit'] == 'login'){
	$qry="SELECT * FROM login WHERE l_username='".$_POST['username']."' AND l_password='".$_POST['password']."'";
	$result = mysqli_query($conn,$qry);
	$rows = mysqli_num_rows($result);
	$row = mysqli_fetch_array($result);
	if($rows==1){
		$_SESSION['name']=$row['l_name'];
		$_SESSION['id']=$row['id'];
		$_SESSION['level']=$row['level'];
		echo "<script>
		window.location.href = 'student_list.php?action=msg_login_success';
		</script>";
	}else{			
		echo "<script>
		window.location.href = 'index.php?action=msg_login_fail';
		</script>";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'logout'){
	session_destroy();
	echo "<script>
	window.location.href = 'index.php?action=msg_logout';
	</script>";
}
?>