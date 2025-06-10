<?php
require('include/db.php');
if(isset($_POST['submit']) && $_POST['submit'] == 'save'){
		
	$qry = "INSERT INTO visitor(s_name,school_name,s_contact,p_contact,s_age,v_date,v_desc,v_status,v_location,v_register_date)VALUES('".mysqli_real_escape_string($conn,$_POST['s_name'])."','".$_POST['m_school']."','".$_POST['s_contact']."','".$_POST['p_contact']."','".$_POST['s_age']."','".$_POST['v_date']."','".$_POST['desc']."','ACTIVE','".$_POST['location']."','".$_POST['r_date']."')";
	//$result = mysqli_query($conn, $qry);
	if($result = mysqli_query($conn, $qry)){
		echo "<script>
		window.location.href = 'visitor_form.php?action=msg_success_add';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'visitor_form.php?action=msg_fail_add';
		</script>";
	}
}

if(isset($_POST['submit']) && $_POST['submit'] == 'edit'){
	$date = '';
	if(isset($_POST['v_date']) && !empty($_POST['v_date'])){
		$date = ",v_date='".$_POST['v_date']."'";
	}
	$r_date = '';
	if(isset($_POST['r_date']) && !empty($_POST['r_date'])){
		$r_date = ",v_register_date='".$_POST['r_date']."'";
	}
	$qry = "UPDATE visitor SET s_name='".mysqli_real_escape_string($conn,$_POST['s_name'])."',school_name='".$_POST['m_school']."',s_contact='".$_POST['s_contact']."',p_contact='".$_POST['p_contact']."',s_age='".$_POST['s_age']."',v_desc='".$_POST['desc']."',v_location='".$_POST['location']."'".$date.$r_date ." WHERE id = '".$_GET['id']."'";
	//$result = mysqli_query($conn, $qry);
	if($result = mysqli_query($conn, $qry)){
		echo "<script>
		window.location.href = 'visitor_edit.php?id=$_GET[id]&action=msg_success_edit';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'visitor_edit.php?id=$_GET[id]&action=msg_fail_edit';
		</script>";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
	$qry = "UPDATE visitor SET v_status = 'DELETE' WHERE id = '".$_GET['id']."'";
	//$result = mysqli_query($conn, $qry);
	if($result = mysqli_query($conn, $qry)){
		echo "<script>
		window.location.href = 'visitor_list.php?id=$_GET[id]&action=msg_success_del';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'visitor_list.php?id=$_GET[id]&action=msg_fail_del';
		</script>";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'unactive'){
	$qry = "UPDATE visitor SET v_status = 'UNACTIVE' WHERE id = '".$_GET['id']."'";
	//$result = mysqli_query($conn, $qry);
	if($result = mysqli_query($conn, $qry)){
		echo "<script>
		window.location.href = 'visitor_list.php?id=$_GET[id]&action=msg_success_unactive';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'visitor_list.php?id=$_GET[id]&action=msg_fail_unactive';
		</script>";
	}
}
?>