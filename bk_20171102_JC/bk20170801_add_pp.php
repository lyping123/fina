<?php
require('include/db.php');
if(isset($_POST['submit']) && $_POST['submit'] == 'save'){
		
	$qry = "INSERT INTO login(l_username,l_password,level,l_name,c_id,dp,l_status)VALUES('".mysqli_real_escape_string($conn,$_POST['username'])."','".mysqli_real_escape_string($conn,$_POST['password'])."','pp','".mysqli_real_escape_string($conn,$_POST['name'])."','".$_POST['course']."','".$_POST['dp']."','ACTIVE')";
	//$result = mysqli_query($conn, $qry);
	if($result = mysqli_query($conn, $qry)){
		echo "<script>
		window.location.href = 'add_pp_form.php?action=msg_success_add';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'add_pp_form.php?action=msg_fail_add';
		</script>";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'edit'){
	
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
			,guardian='".mysqli_real_escape_string($conn,$_POST['guardian'])."',school='".mysqli_real_escape_string($conn,$_POST['school'])."'
			,birthday='".$_POST['birthday']."',age='".mysqli_real_escape_string($conn,$_POST['age'])."',gender='".$_POST['gender']."'
			,m_status='".$_POST['m_status']."',religion='".$_POST['religion']."',s_desc='".mysqli_real_escape_string($conn,$_POST['desc'])."'
			,tuition_fee='".mysqli_real_escape_string($conn,$_POST['fee'])."',p_method='".$_POST['p_mothod']."'
			,cost_per_month='".mysqli_real_escape_string($conn,$_POST['cost'])."',p_month='".mysqli_real_escape_string($conn,$_POST['month'])."'
			,date_join='".$_POST['join_date']."',course='".$_POST['course']."'".$new_file.$hostel." ,i_fee='".$_POST['i_fee']."' WHERE id = '".$_GET['id']."'";
			if($result = mysqli_query($conn, $qry)){
				echo "<script>
				window.location.href = 'student_list.php?action=msg_success_edit';
				</script>";
			}else{
				echo "<script>
				window.location.href = 'student_edit.php?id='".$_GET['id']."'&action=msg_fail_edit';
				</script>";
			}
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