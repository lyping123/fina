<?php
require('include/db.php');
if(isset($_POST['submit']) && $_POST['submit'] == 'save'){
	
	$c_name=mysqli_real_escape_string($conn,$_POST["c_name"]);
	$b_date=mysqli_real_escape_string($conn,$_POST["b_date"]);
	$nationality=mysqli_real_escape_string($conn,$_POST["nationality"]);
	$gender=mysqli_real_escape_string($conn,$_POST["gender"]);
	$m_status=mysqli_real_escape_string($conn,$_POST["m_status"]);
	$race=mysqli_real_escape_string($conn,$_POST["race"]);
	$religion=mysqli_real_escape_string($conn,$_POST["religion"]);
	$postcode=mysqli_real_escape_string($conn,$_POST["postcode"]);
	$state=mysqli_real_escape_string($conn,$_POST["state"]);
	$email=mysqli_real_escape_string($conn,$_POST["email"]);

	$qry = "INSERT INTO visitor(`s_name`,`school_name`,`c_name`, `b_date`, `nationality`, `gender`, `m_status`, `race`, `religion`, `postcode`, `state`, `email`,`s_contact`,`p_contact`,`s_age`,`v_date`,`v_desc`,`v_status`,`v_location`,`s_ic`)
	VALUES('".mysqli_real_escape_string($conn,$_POST['s_name'])."','".mysqli_real_escape_string($conn,$_POST['m_school'])."', 
	'$c_name','$b_date','$nationality','$gender','$m_status','$race','$religion','$postcode','$state','$email',
	'".mysqli_real_escape_string($conn,$_POST['s_contact'])."','".mysqli_real_escape_string($conn,$_POST['p_contact'])."','".mysqli_real_escape_string($conn,$_POST['s_age'])."','".$_POST['v_date']."','".mysqli_real_escape_string($conn,$_POST['desc'])."','ACTIVE','".mysqli_real_escape_string($conn,$_POST['location'])."','$_POST[s_ic]')";
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
	$c_name=mysqli_real_escape_string($conn,$_POST["c_name"]);
	$b_date=mysqli_real_escape_string($conn,$_POST["b_date"]);
	$nationality=mysqli_real_escape_string($conn,$_POST["nationality"]);
	$gender=mysqli_real_escape_string($conn,$_POST["gender"]);
	$m_status=mysqli_real_escape_string($conn,$_POST["m_status"]);
	$race=mysqli_real_escape_string($conn,$_POST["race"]);
	$religion=mysqli_real_escape_string($conn,$_POST["religion"]);
	$postcode=mysqli_real_escape_string($conn,$_POST["postcode"]);
	$state=mysqli_real_escape_string($conn,$_POST["state"]);
	$email=mysqli_real_escape_string($conn,$_POST["email"]);
	$qry = "UPDATE visitor SET s_name='".mysqli_real_escape_string($conn,$_POST['s_name'])."',school_name='".mysqli_real_escape_string($conn,$_POST['m_school'])."',
	c_name='$c_name',
	b_date='$b_date',
	nationality='$nationality',
	gender='$gender',
	m_status='$m_status',
	race='$race',
	religion='$religion',
	postcode='$postcode',
	state='$state',
	email='$email',
	s_ic='$_POST[s_ic]',
	s_contact='".mysqli_real_escape_string($conn,$_POST['s_contact'])."',p_contact='".mysqli_real_escape_string($conn,$_POST['p_contact'])."',s_age='".mysqli_real_escape_string($conn,$_POST['s_age'])."',v_desc='".mysqli_real_escape_string($conn,$_POST['desc'])."',v_location='".mysqli_real_escape_string($conn,$_POST['location'])."'".$date." WHERE id = '".$_GET['id']."'";
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