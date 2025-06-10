<?php
require('include/db.php');
if(isset($_POST['submit']) && $_POST['submit'] == 'save'){
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
	$query_ic="select * from student where ic='".$_POST['ic']."' and s_status='ACTIVE'";
	$sttr=mysqli_query($conn,$query_ic);
	$rows=mysqli_num_rows($sttr);
	if($rows>0){
		echo "aaa";
		if(isset($_GET['id'])){
			echo "<script>alert('The IC number is repeat')
				window.location.href='new_student.php?id=".$_GET['id']."'
			</script>"; 
			break;
		}
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
			$qry = "INSERT INTO student(tuition_fee_left,s_email,s_id,s_name,ic,nationality,race,r_address,r_postcode,r_state,c_address
			,c_postcode,c_state,chinese_name,h_contact,hp_contact,guardian,birthday,age,gender,m_status,religion
			,s_desc,s_status,tuition_fee,p_method,cost_per_month,date_join,course,photo".$a_hostel.",i_fee,p_id,g_id)VALUES('".$_POST['l_fee']."','".mysqli_real_escape_string($conn,$_POST['email'])."'
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
			,'".mysqli_real_escape_string($conn,$_POST['cost'])."','".$_POST['join_date']."','".$_POST['course']."','".$file."'".$b_hostel.",'".$_POST['i_fee']."','".$_POST['pp']."','".$_POST['group']."')";
			//$result = mysqli_query($conn, $qry);
			if($result = mysqli_query($conn, $qry)){
				$id = mysqli_insert_id($conn);
				$qry1 = "UPDATE visitor SET v_register_date='".DATE_TODAY."', s_id='".$id."' WHERE id = '".$_GET['id']."'";
				if($result1 = mysqli_query($conn, $qry1)){
					echo "<script>
					window.location.href = 'student_list.php?action=msg_success_add';
					</script>";
				}else{
					echo "<script>
					window.location.href = 'new_student.php?id=$_GET[id]&action=msg_fail_add1';
					</script>";
				}
			}else{
				echo "<script>
				window.location.href = 'new_student.php?id=$_GET[id]&action=msg_fail_add';
				</script>";
			}
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
		$semester='';
		if(isset($_POST['p_mothod'])&&$_POST['p_mothod']=="semester"){
			$min=-$_POST['semester'];
			$semester.=",p_month='".$min."'";
		}
		
			$new_file='';
			if(isset($file) && !empty($file)){
				$new_file .= " ,photo='".$file."'";
			}else{
				$new_file = '';
			}
			mysqli_set_charset($conn, 'utf8');
			$qry = "UPDATE student SET outstanding='".$_POST['outstanding']."'".$semester.",total_pay='".$_POST['t_pay']."' ,tuition_fee_left='".$_POST['l_fee']."' ,s_email='".mysqli_real_escape_string($conn,$_POST['email'])."'
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
			,cost_per_month='".mysqli_real_escape_string($conn,$_POST['cost'])."',date_join='".$_POST['join_date']."',course='".$_POST['course']."'".$new_file.$hostel." ,i_fee='".$_POST['i_fee']."' WHERE id = '".$_GET['id']."'";
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

if(isset($_GET['action']) && $_GET['action'] == 'graduate'){
	$qry = "UPDATE student SET s_status = 'GRADUATE' WHERE id = '".$_GET['id']."'";
    $select_qry="select * from student where id='".$_GET['id']."'";
    $sttr=mysqli_query($conn,$select_qry);
    $select_result=mysqli_fetch_array($sttr);
    $cid=0;
    if($select_result['course']=="Programming"){
        $cid=5;
    }elseif($select_result['course']=="Accounting"){
        $cid=1;
    }
    elseif($select_result['course']=="Networking"){
        $cid=4;
    }
    elseif($select_result['course']=="Electronic"){
        $cid=2;
    }
    elseif($select_result['course']=="Multimedia"){
        $cid=3;
    }
    echo $insert_qry="insert into job_tracer(c_id,s_name,s_contact,s_ic,j_status)values('".$cid."','".$select_result['s_name']."','".$select_result['hp_contact']."','".$select_result['ic']."','ACTIVE')";
    
		if($result=mysqli_query($conn, $qry)){
            $result_sttr=mysqli_query($conn,$insert_qry);
			echo "<script>
			window.location.href = 'student_list.php?action=msg_success_del';
			</script>";
		}else{
			echo "<script>
			window.location.href = 'student_list.php?action=msg_fail_del';
			</script>";
		}
}


if(isset($_GET['action']) && $_GET['action'] == 'quit'){
	$qry = "UPDATE student SET s_status = 'QUIT' WHERE id = '".$_GET['id']."'";
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