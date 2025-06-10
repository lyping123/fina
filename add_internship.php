<?php 
require ('include/db.php');
require ('include/function.inc.php');

if(isset($_POST['add_internship'])){
	$s_name = mysqli_real_escape_string($conn,$_POST['s_name']);
	$s_contact = mysqli_real_escape_string($conn,clean($_POST['s_contact']));
	$s_ic = mysqli_real_escape_string($conn,clean($_POST['s_ic']));
	$c_name = mysqli_real_escape_string($conn,$_POST['c_name']);
	$c_address = mysqli_real_escape_string($conn,$_POST['c_address']);
	$c_contact = mysqli_real_escape_string($conn,clean($_POST['c_contact']));
	$elaun = mysqli_real_escape_string($conn,clean($_POST['elaun']));
	$si_date = mysqli_real_escape_string($conn,$_POST['si_date']);
	$ei_date = mysqli_real_escape_string($conn,$_POST['ei_date']);
	$course = $_POST['course'];
	$batch = mysqli_real_escape_string($conn,clean($_POST['batch']));
	
	$qry = "INSERT INTO internship(c_id,s_name,s_contact,s_ic,company_name,company_address,company_contact,elaun,start_internship,batch,end_internship,i_status)VALUES('".$course."','".$s_name."','".$s_contact."','".$s_ic."','".$c_name."','".$c_address."','".$c_contact."','".$elaun."','".$si_date."','".$batch."','".$ei_date."','ACTIVE')";
	if($result = mysqli_query($conn, $qry)){
		echo "<script>
		window.location.href = 'internship.php?action=msg_success_add';
		</script>";
		
	}else{
		echo "<script>
		window.location.href = 'internship.php?action=msg_fail_add';
		</script>";
		
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id']) && !empty($_GET['id'])){
	$qry = "UPDATE internship SET i_status = 'DELETE' WHERE id = '".$_GET['id']."'";
	if($result = mysqli_query($conn, $qry)){
		echo "<script>
		window.location.href = 'internship.php?action=msg_success_del';
		</script>";
		
	}else{
		echo "<script>
		window.location.href = 'internship.php?action=msg_fail_del';
		</script>";
		
	}
}

if(isset($_POST['update_internship']) && isset($_GET['id']) && !empty($_GET['id'])){
	$s_name = mysqli_real_escape_string($conn,$_POST['s_name']);
	$s_contact = mysqli_real_escape_string($conn,clean($_POST['s_contact']));
	$s_ic = mysqli_real_escape_string($conn,clean($_POST['s_ic']));
	$c_name = mysqli_real_escape_string($conn,$_POST['c_name']);
	$c_address = mysqli_real_escape_string($conn,$_POST['c_address']);
	$c_contact = mysqli_real_escape_string($conn,clean($_POST['c_contact']));
	$elaun = mysqli_real_escape_string($conn,clean($_POST['elaun']));
	$si_date = mysqli_real_escape_string($conn,$_POST['si_date']);
	$ei_date = mysqli_real_escape_string($conn,$_POST['ei_date']);
	$course = $_POST['course'];
	$batch = mysqli_real_escape_string($conn,clean($_POST['batch']));
	
	$qry = "UPDATE internship SET c_id='".$course."',s_name='".$s_name."', s_contact='".$s_contact."', s_ic='".$s_ic."', company_name='".$c_name."', company_address='".$c_address."', company_contact='".$c_contact."', elaun='".$elaun."', start_internship='".$si_date."', end_internship='".$ei_date."', batch='".$batch."' WHERE id = '".$_GET['id']."'";
	if($result = mysqli_query($conn, $qry)){
		echo "<script>
		window.location.href = 'internship.php?action=msg_success_edit';
		</script>";
		
	}else{
		echo "<script>
		window.location.href = 'internship.php?action=msg_fail_edit';
		</script>";
		
	}
	
}
if(isset($_POST['submit'])){
	$s_name = mysqli_real_escape_string($conn,$_POST['name']);
	$s_contact = mysqli_real_escape_string($conn,clean($_POST['hp_contact']));
	$s_ic = mysqli_real_escape_string($conn,clean($_POST['ic']));
	$c_name = mysqli_real_escape_string($conn,$_POST['c_name']);
	$c_address = mysqli_real_escape_string($conn,$_POST['c_address']);
	$c_contact = mysqli_real_escape_string($conn,clean($_POST['c_con']));
	$elaun = mysqli_real_escape_string($conn,clean($_POST['elaun']));
	$si_date = mysqli_real_escape_string($conn,$_POST['start_date']);
	$ei_date = mysqli_real_escape_string($conn,$_POST['end_date']);
	$course = $_POST['course'];
	
	
	 $query="INSERT INTO internship(c_id,s_name,s_contact,s_ic,company_name,company_address,company_contact,elaun,start_internship,batch,end_internship,i_status)VALUES('".$course."','".$s_name."','".$s_contact."','".$s_ic."','".$c_name."','".$c_address."','".$c_contact."','','".$si_date."','','".$ei_date."','ACTIVE')";
	$query_update="update student set s_status='INTERNSHIP',after_internship='YES'where id='".$_POST['id']."'";
	$sttr_update=mysqli_query($conn,$query_update);
	if($result=mysqli_query($conn,$query)){
		echo "<script>window.location.href='student_list.php?action=msg_success_add'</script>";	
	}
	else{
		echo "<script>window.location.href='student_list.php?action=msg_fail_add'</script>";	
	}
}
?>