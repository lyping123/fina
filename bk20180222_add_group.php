<?php
require('include/db.php');
if(isset($_POST['submit']) && $_POST['submit'] == 'save'){
	$c_qry = "SELECT * FROM login WHERE id = '".$_POST['pp']."'";
	$c_result = mysqli_query($conn,$c_qry);
	$c_row = mysqli_fetch_array($c_result);
	
	$qry = "INSERT INTO student_group(c_id,g_name,g_status,g_level,p_id,jpk_pp_id,start_date,end_date)VALUES('".mysqli_real_escape_string($conn,$_POST['course'])."','".mysqli_real_escape_string($conn,$_POST['gname'])."','ACTIVE','".$_POST['level']."','".$_POST['pp']."','".$_POST['jpkpp']."','".$_POST['sd']."','".$_POST['ed']."')";
	//$result = mysqli_query($conn, $qry);
	if($result = mysqli_query($conn, $qry)){
		echo "<script>
		window.location.href = 'add_group_form.php?action=msg_success_add';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'add_group_form.php?action=msg_fail_add';
		</script>";
	}
}
if(isset($_GET['action']) && $_GET['action'] == 'edit'){
	$qry = "UPDATE student_group SET c_id = '".mysqli_real_escape_string($conn,$_POST['course'])."', g_name = '".mysqli_real_escape_string($conn,$_POST['gname'])."', g_status = 'ACTIVE', g_level = '".$_POST['level']."', p_id = '".$_POST['pp']."', jpk_pp_id = '".$_POST['jpkpp']."', start_date = '".$_POST['sd']."', end_date = '".$_POST['ed']."' WHERE id = '".$_GET['id']."'";
	if($result = mysqli_query($conn, $qry)){
		echo "<script>
		window.location.href = 'edit_group.php?action=msg_success_edit&id=$_GET[id]';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'edit_group.php?action=msg_fail_edit&id=$_GET[id]';
		</script>";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
	$qry = "UPDATE student_group SET g_status = 'DELETE' WHERE id = '".$_GET['id']."'";
		if($result = mysqli_query($conn, $qry)){
			echo "<script>
			window.location.href = 'group_list.php?action=msg_success_del';
			</script>";
		}else{
			echo "<script>
			window.location.href = 'group_list.php?action=msg_fail_del';
			</script>";
		}
}

?>