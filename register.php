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
			
			echo "<script>alert('The IC number is repeat')
				window.location.href='registration_form.php'
			</script>"; 
			break;
		
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
			$a_hostel .= ',h_status';
			$b_hostel .= ",'YES'";
            
		}else{
			$a_hostel .= ',h_status';
			$b_hostel .= ",'NO'";
		}
			mysqli_set_charset($conn, 'utf8');
			$semester=0;
			if($_POST['p_mothod']=="semester"){
				$semester-=6;
			}
			
			$qry = "INSERT INTO student(p_month,tuition_fee_left,s_email,s_id,s_name,ic,nationality,race,r_address,r_postcode,r_state,c_address
			,c_postcode,c_state,chinese_name,h_contact,hp_contact,guardian,birthday,age,gender,m_status,religion
			,s_desc,s_status,tuition_fee,p_method,cost_per_month,date_join,course,photo".$a_hostel.",i_fee)VALUES('".$semester."','".$_POST['l_fee']."','".mysqli_real_escape_string($conn,$_POST['email'])."'
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
			,'".mysqli_real_escape_string($conn,$_POST['cost'])."','".$_POST['join_date']."','".$_POST['course']."','".$file."'".$b_hostel.",'".$_POST['i_fee']."')";
			//$result = mysqli_query($conn, $qry);
			if($result = mysqli_query($conn, $qry)){
                $lastid=$conn->insert_id;
                if(isset($_POST['hostel'])){
                    echo $c_qry = "SELECT * FROM hostel WHERE h_status = 'ACTIVE' and id='".$_POST['hostel1']."'";
                    $c_result = mysqli_query($conn, $c_qry);
                    $c_row=mysqli_fetch_array($c_result);
                    echo $count="select count(id) as count from student_detail where h_id='".$_POST['hostel1']."' and s_status='ACTIVE'";
                    $sttr_count=mysqli_query($conn,$count);
                    $result_count=mysqli_fetch_array($sttr_count);
                    echo $slot=$c_row['slot']-$result_count['count'];
                    if($slot>0){
                        $qey="insert into student_detail(s_id,s_phone,p_name,p_phone,h_id,s_status,pp_name,date_checkin,security_deposit)value('".$lastid."','".$_POST['hp_contact']."','".$_POST['p_name']."','".$_POST['p_con']."','".$_POST['hostel1']."','ACTIVE','".$_POST['pp_name']."','".$_POST['check_in']."','".$_POST['s_deposit']."')";
                         $sttr=mysqli_query($conn,$qey);
                    }
                    else{
                        
                        echo "<script>
                        alert('hostel slot is full')
				        //window.location.href = 'registration_form.php?action=msg_slotfull_add';
				        </script>";
                    }
                    
                }
            
				echo "<script>
				//window.location.href = 'student_list.php?action=msg_success_add';
				</script>";
			}else{
				echo "<script>
				//window.location.href = 'new_student.php?id=$_GET[id]&action=msg_fail_add';
				</script>";
			}
		}
}

?>