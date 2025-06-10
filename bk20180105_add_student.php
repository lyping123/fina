<?php
require('include/db.php');
if(isset($_POST['submit']) && $_POST['submit'] == 'save'){
	$c_qry = "SELECT * FROM student WHERE p_id = '".$_POST['pp']."' AND s_status = 'ACTIVE'";
	$c_result = mysqli_query($conn,$c_qry);
	$c_rows = mysqli_num_rows($c_result);
	
	if($c_rows < 25){
	if(!empty($_FILES['photo']['name']))
	{
		$ext = explode(".", $_FILES['photo']['name']);
		$ext = strtolower(array_pop($ext));
		$file = "img/P".date('YmdHis').'.'.$ext;
		/*$file = $_FILES['image']['name'];*/
		
		if(($ext == "jpg" || $ext == "jpeg" || $ext == "png")){ 
		    $target_path = $file;
		}else{
		    $error_ext = 1;
		}
		  
		//if(file_exists('img/'.$_FILES['image1']['name'])){
		if(file_exists($file)){
			$file_exists = 1;
		}
	}else{
		$file = '';
	}

	if(isset($error_ext)){
		echo "<script>alert('Please upload .jpg, .png file only.')</script>"; 
	}elseif(isset($file_exists)){
		echo "<script>alert('Photo already exists, please choose another photo.')</script>"; 
	}elseif(isset($target_path) && !move_uploaded_file($_FILES['photo']['tmp_name'], $target_path)){
		echo "<script>alert('Photo failed to upload.')</script>";  
    }else{
		$a_hostel = '';
		$b_hostel = '';
		if(isset($_POST['hostel'])){
			$a_hostel .= ',h_status,h_fee,h_cost_per_month,h_month';
			$b_hostel .= ",'YES','".mysqli_real_escape_string($conn,$_POST['h_fee'])."','".mysqli_real_escape_string($conn,$_POST['h_cost'])."','".mysqli_real_escape_string($conn,$_POST['h_month'])."'";
		}else{
			$a_hostel .= ',h_status';
			$b_hostel .= ",'NO'";
		}
			mysqli_set_charset($conn, 'utf8');
			$qry = "INSERT INTO student(s_email,s_id,s_name,ic,nationality,race,r_address,r_postcode,r_state,c_address
			,c_postcode,c_state,chinese_name,h_contact,hp_contact,guardian,birthday,age,gender,m_status,religion
			,s_desc,s_status,tuition_fee,p_method,cost_per_month,p_month,date_join,course,photo".$a_hostel.",i_fee,p_id,g_id)VALUES('".mysqli_real_escape_string($conn,$_POST['email'])."'
			,'".mysqli_real_escape_string($conn,$_POST['s_id'])."','".mysqli_real_escape_string($conn,$_POST['name'])."'
			,'".mysqli_real_escape_string($conn,$_POST['ic'])."','".mysqli_real_escape_string($conn,$_POST['nationality'])."'
			,'".$_POST['race']."','".mysqli_real_escape_string($conn,$_POST['r_address'])."'
			,'".mysqli_real_escape_string($conn,$_POST['r_postcode'])."','".$_POST['r_state']."'
			,'".mysqli_real_escape_string($conn,$_POST['c_address'])."','".mysqli_real_escape_string($conn,$_POST['c_postcode'])."'
			,'".$_POST['c_state']."','".mysqli_real_escape_string($conn,$_POST['c_name'])."','".mysqli_real_escape_string($conn,$_POST['h_contact'])."'
			,'".mysqli_real_escape_string($conn,$_POST['hp_contact'])."','".mysqli_real_escape_string($conn,$_POST['guardian'])."'
			,'".$_POST['birthday']."'
			,'".mysqli_real_escape_string($conn,$_POST['age'])."','".$_POST['gender']."','".$_POST['m_status']."'
			,'".$_POST['religion']."','".mysqli_real_escape_string($conn,$_POST['desc'])."','ACTIVE'
			,'".mysqli_real_escape_string($conn,$_POST['fee'])."','".$_POST['p_mothod']."'
			,'".mysqli_real_escape_string($conn,$_POST['cost'])."','".mysqli_real_escape_string($conn,$_POST['month'])."'
			,'".$_POST['join_date']."','".$_POST['course']."','".$file."'".$b_hostel.",'".$_POST['i_fee']."','".$_POST['pp']."','".$_POST['group']."')";
			//$result = mysqli_query($conn, $qry);
			if($result = mysqli_query($conn, $qry)){
				echo "<script>
				window.location.href = 'student_list.php?action=msg_success_add';
				</script>";
			}else{
				echo "<script>
				window.location.href = 'new_student.php?action=msg_fail_add';
				</script>";
			}
		}
	}else{
		echo "<script>
		window.location.href = 'new_student.php?action=msg_limit';
		</script>";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'edit'){
	$c_qry = "SELECT * FROM student WHERE p_id = '".$_POST['pp']."' AND s_status = 'ACTIVE'";
	$c_result = mysqli_query($conn,$c_qry);
	$c_rows = mysqli_num_rows($c_result);
	
	if($c_rows < 25){
	
	if(!empty($_FILES['photo']['name']))
	{
		$ext = explode(".", $_FILES['photo']['name']);
		$ext = strtolower(array_pop($ext));
		$file = "img/P".date('YmdHis').'.'.$ext;
		/*$file = $_FILES['image']['name'];*/
		
		if(($ext == "jpg" || $ext == "jpeg" || $ext == "png")){ 
		    $target_path = $file;
		}else{
		    $error_ext = 1;
		}
		  
		//if(file_exists('img/'.$_FILES['image1']['name'])){
		if(file_exists($file)){
			$file_exists = 1;
		}
	}

	if(isset($error_ext)){
		echo "<script>alert('Please upload .jpg, .png file only.')</script>"; 
	}elseif(isset($file_exists)){
		echo "<script>alert('Photo already exists, please choose another photo.')</script>"; 
	}elseif(isset($target_path) && !move_uploaded_file($_FILES['photo']['tmp_name'], $target_path)){
		echo "<script>alert('Photo failed to upload.')</script>";  
    }else{
		$hostel = '';
		if(isset($_POST['hostel'])){
			$hostel .= ",h_status='YES',h_fee='".mysqli_real_escape_string($conn,$_POST['h_fee'])."',h_cost_per_month='".mysqli_real_escape_string($conn,$_POST['h_cost'])."',h_month='".mysqli_real_escape_string($conn,$_POST['h_month'])."'";
		}else{
			$hostel .= ",h_status='NO'";
		}
			$new_file='';
			if(isset($file) && !empty($file)){
				$new_file .= " ,photo='".$file."'";
			}else{
				$new_file = '';
			}
			mysqli_set_charset($conn, 'utf8');
			$qry = "UPDATE student SET s_email='".mysqli_real_escape_string($conn,$_POST['email'])."'
			,s_id='".mysqli_real_escape_string($conn,$_POST['s_id'])."',s_name='".mysqli_real_escape_string($conn,$_POST['name'])."'
			,ic='".mysqli_real_escape_string($conn,$_POST['ic'])."',nationality='".mysqli_real_escape_string($conn,$_POST['nationality'])."'
			,race='".$_POST['race']."',r_address='".mysqli_real_escape_string($conn,$_POST['r_address'])."'
			,r_postcode='".mysqli_real_escape_string($conn,$_POST['r_postcode'])."',r_state='".$_POST['r_state']."'
			,c_address='".mysqli_real_escape_string($conn,$_POST['c_address'])."',c_postcode='".mysqli_real_escape_string($conn,$_POST['c_postcode'])."'
			,c_state='".$_POST['c_state']."',chinese_name='".mysqli_real_escape_string($conn,$_POST['c_name'])."'
			,h_contact='".mysqli_real_escape_string($conn,$_POST['h_contact'])."',hp_contact='".mysqli_real_escape_string($conn,$_POST['hp_contact'])."'
			,guardian='".mysqli_real_escape_string($conn,$_POST['guardian'])."',birthday='".$_POST['birthday']."',age='".mysqli_real_escape_string($conn,$_POST['age'])."',gender='".$_POST['gender']."'
			,m_status='".$_POST['m_status']."',religion='".$_POST['religion']."',s_desc='".mysqli_real_escape_string($conn,$_POST['desc'])."'
			,tuition_fee='".mysqli_real_escape_string($conn,$_POST['fee'])."',p_method='".$_POST['p_mothod']."'
			,cost_per_month='".mysqli_real_escape_string($conn,$_POST['cost'])."',p_month='".mysqli_real_escape_string($conn,$_POST['month'])."'
			,date_join='".$_POST['join_date']."',course='".$_POST['course']."'".$new_file.$hostel." ,i_fee='".$_POST['i_fee']."',p_id='".$_POST['pp']."',g_id='".$_POST['group']."' WHERE id = '".$_GET['id']."'";
			if($result = mysqli_query($conn, $qry)){
				echo "<script>
				window.location.href = 'student_edit.php?action=msg_success_edit&id=$_GET[id]';
				</script>";
			}else{
				echo "<script>
				window.location.href = 'student_edit.php?id=$_GET[id]&action=msg_fail_edit';
				</script>";
			}
		}
	}else{
		echo "<script>
		window.location.href = 'student_edit.php?id=$_GET[id]&action=msg_limit';
		</script>";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
	$qry = "UPDATE student SET s_status = 'DELETE' WHERE id = '".$_GET['id']."'";
		if($result = mysqli_query($conn, $qry)){
			echo "<script>
			window.location.href = 'student_list.php?action=msg_success_del';
			</script>";
		}else{
			echo "<script>
			window.location.href = 'student_list.php?action=msg_fail_del';
			</script>";
		}
}

?>