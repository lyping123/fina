<?php
require('include/db.php');

if(isset($_POST['submit']) && $_POST['submit'] == 'save'){
	$qry = "INSERT INTO verification(s_name, s_ic, s_date, e_date, department, course_name, s1, s2, s3, s4, s5, s6, v_status)VALUES('".$_POST['name']."', '".$_POST['ic']."', '".$_POST['sd']."', '".$_POST['ed']."', '".$_POST['course']."', '".$_POST['cname']."', '".$_POST['s1']."', '".$_POST['s2']."', '".$_POST['s3']."', '".$_POST['s4']."', '".$_POST['s5']."', '".$_POST['s6']."', 'ACTIVE')";
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