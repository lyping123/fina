<?php
require('include/db.php');

if(isset($_POST['submit']) && $_POST['submit'] == 'save'){
	$qry = "INSERT INTO verification(s_name, s_ic, s_date, e_date, department, course_name, s5, v_status)VALUES('".mysqli_real_escape_string($conn,$_POST['name'])."', '".$_POST['ic']."', '".$_POST['sd']."', '".$_POST['ed']."', '".$_POST['course']."', '".$_POST['cname']."', '".$_POST['s6']."', 'ACTIVE')";
	if($result = mysqli_query($conn, $qry)){
		echo "<script>
		window.location.href = 'verification_form.php?action=msg_success_add';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'verification_form.php?action=msg_fail_add';
		</script>";
	}
}

if(isset($_POST['submit']) && $_POST['submit'] == 'edit'){
	$qry = "UPDATE verification SET s_name = '".mysqli_real_escape_string($conn,$_POST['name'])."', s_ic = '".$_POST['ic']."', s_date = '".$_POST['sd']."', e_date = '".$_POST['ed']."', department = '".$_POST['course']."', course_name = '".$_POST['cname']."', s5 = '".$_POST['s6']."' WHERE id = '".$_GET['id']."'";
	if($result = mysqli_query($conn, $qry)){
		echo "<script>
		window.location.href = 'edit_verification.php?action=msg_success_edit&id=$_GET[id]';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'edit_verification.php?action=msg_fail_edit&id=$_GET[id]';
		</script>";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
	$qry = "UPDATE verification SET v_status = 'DELETE' WHERE id = '".$_GET['id']."'";
	if($result = mysqli_query($conn, $qry)){
		echo "<script>
		window.location.href = 'verification_list.php?action=msg_success_del';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'verification_list.php?action=msg_fail_del';
		</script>";
	}
}
?>