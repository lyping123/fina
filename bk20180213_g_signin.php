<?php
require('include/db.php');

if(isset($_POST['submit']) && $_POST['submit'] == 'add'){
	$qry = "INSERT INTO student_group_list(g_id,s_id,status)VALUES('".$_GET['group']."', '".$_POST['name']."', 'ACTIVE')";
	if($result = mysqli_query($conn, $qry)){
		echo "<script>
		window.location.href = 'g_signin_list.php?action=msg_success_add&id=$_GET[group]';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'g_signin_list.php?action=msg_fail_add&id=$_GET[group]';
		</script>";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
	$qry = "UPDATE student_group_list SET status = 'DELETE' WHERE id = '".$_GET['id']."'";
		if($result = mysqli_query($conn, $qry)){
			echo "<script>
			window.location.href = 'g_signin_list.php?action=msg_success_del&id=$_GET[group]';
			</script>";
		}else{
			echo "<script>
			window.location.href = 'g_signin_list.php?action=msg_fail_del&id=$_GET[group]';
			</script>";
		}
}
?>