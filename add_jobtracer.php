<?php 
require ('include/db.php');
require ('include/function.inc.php');

if(isset($_POST['add_jobtracer'])){
	$s_name = mysqli_real_escape_string($conn,$_POST['s_name']);
	$s_contact = mysqli_real_escape_string($conn,clean($_POST['s_contact']));
	$s_ic = mysqli_real_escape_string($conn,clean($_POST['s_ic']));
	$c_name = mysqli_real_escape_string($conn,$_POST['c_name']);
	$c_address = mysqli_real_escape_string($conn,$_POST['c_address']);
	$c_contact = mysqli_real_escape_string($conn,clean($_POST['c_contact']));
	//$s_school=mysqli_real_escape_string($conn,clean($_POST['secondary_school']));
	$position = mysqli_real_escape_string($conn,$_POST['position']);
	$salary = mysqli_real_escape_string($conn,clean($_POST['salary']));
	$s_w_date = mysqli_real_escape_string($conn,$_POST['s_w_date']);
	$course = $_POST['course1'];
	$batch = mysqli_real_escape_string($conn,clean($_POST['batch']));
	 $course;
	 $qry = "INSERT INTO job_tracer(c_id,s_name,s_contact,s_ic,company_name,company_address,company_contact,position,salary,start_working_date,batch,j_status)VALUES('".$course."','".$s_name."','".$s_contact."','".$s_ic."','".$c_name."','".$c_address."','".$c_contact."','".$position."','".$salary."','".$s_w_date."','".$batch."','ACTIVE')";
	if($result = mysqli_query($conn, $qry)){
		echo "<script>
		window.location.href = 'job_tracer.php?action=msg_success_add';
		</script>";
		
	}else{
		echo "<script>
		window.location.href = 'job_tracer.php?action=msg_fail_add';
		</script>";
		
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
	$qry = "UPDATE job_tracer SET j_status = 'DELETE' WHERE id = '".$_GET['id']."'";
	if($result = mysqli_query($conn, $qry)){
		echo "<script>
		window.location.href = 'job_tracer.php?action=msg_success_del';
		</script>";
		
	}else{
		echo "<script>
		window.location.href = 'job_tracer.php?action=msg_fail_del';
		</script>";
		
	}
}

if(isset($_POST['update_jobtracer']) && isset($_GET['id']) && !empty($_GET['id'])){
    
	$s_name = mysqli_real_escape_string($conn,$_POST['s_name']);
	$s_contact = mysqli_real_escape_string($conn,clean($_POST['s_contact']));
	$s_ic = mysqli_real_escape_string($conn,clean($_POST['s_ic']));
	$c_name = mysqli_real_escape_string($conn,$_POST['c_name']);
	$c_address = mysqli_real_escape_string($conn,$_POST['c_address']);
	$c_contact = mysqli_real_escape_string($conn,clean($_POST['c_contact']));
	//$s_school=mysqli_real_escape_string($conn,clean($_POST['c_school']));
	$position = mysqli_real_escape_string($conn,$_POST['position']);
	$salary = mysqli_real_escape_string($conn,clean($_POST['salary']));
	$s_w_date = mysqli_real_escape_string($conn,$_POST['s_w_date']);
	$batch = mysqli_real_escape_string($conn,clean($_POST['batch']));
	$course = $_POST['course'];
	
	$qry = "UPDATE job_tracer SET c_id='".$course."', s_name='".$s_name."', s_contact='".$s_contact."', s_ic='".$s_ic."', company_name='".$c_name."', company_address='".$c_address."', company_contact='".$c_contact."', position='".$position."', salary='".$salary."', start_working_date='".$s_w_date."', batch='".$batch."' WHERE id = '".$_GET['id']."'";
	if($result = mysqli_query($conn, $qry)){
		echo "<script>
		window.location.href = 'job_tracer.php?action=msg_success_edit';
		</script>";
		
	}else{
		echo "<script>
		window.location.href = 'job_tracer.php?action=msg_fail_edit';
		</script>";
		
	}
}

?>