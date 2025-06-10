<?php
require('include/db.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
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
	if($rows == 0){


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
			
			$qry = "INSERT INTO student(birth_sen,p_month,s_email,s_id,s_name,ic,nationality,race,r_address,r_postcode,r_state,c_address
			,c_postcode,c_state,chinese_name,h_contact,hp_contact,guardian,birthday,age,gender,m_status,religion
			,s_desc,s_status,tuition_fee,p_method,date_join,course,photo".$a_hostel.",i_fee)VALUES('".$_POST["b_sen"]."','".$semester."','".mysqli_real_escape_string($conn,$_POST['email'])."'
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
			,'".$_POST['join_date']."','".$_POST['course']."','".$file."'".$b_hostel.",'".$_POST['i_fee']."')";
                if($result = mysqli_query($conn, $qry)){
                    $id = mysqli_insert_id($conn);
					function generateRandomPassword($lenght = 8){
						$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						$password = '';
					
						for ($i=0; $i < $lenght ; $i++) { 
							# code...
							$password .=$characters[rand(0,strlen($characters)-1)];
						}
						return $password;
					
					}  
	
					$random_password = generateRandomPassword();
	
					$hashed_pass = password_hash($random_password,PASSWORD_DEFAULT);
	
					$insert_login_query = "INSERT INTO student_login(student_ic, password, status) VALUES ('".$_POST['ic']."', '".$hashed_pass."', '1st_login')";
					mysqli_query($conn, $insert_login_query);
	
	
					$mail = new PHPMailer(true);
				
					try{
						$mail->isSMTP();
						$mail->Host = 'smtp.gmail.com'; //SMTP Server address
						$mail->SMTPAuth = true;
						$mail->Username = 'synergycollegenet@gmail.com'; //SMTP username(Email)
						$mail->Password = 'zhvskykulmxzfcgg'; //SMTP Password
						$mail->SMTPSecure = 'tls';
						$mail->Port = 587;
				
						$mail->setFrom('synergycollege@gmail.com', 'Synergy College');
						$mail->AddReplyTo('no-reply@gmail.com',"No Reply");			
				
				
						$mail->addAddress($_POST['email'], $_POST['name']);
						// $mail->addAddress('shaoxi9733@gmail.com', 'Testing');
				
						$mail->isHTML(true);
						$mail->Subject = 'Your Password for Student Portal';
						$mail->Body = 'Hello, ' . $_POST['name'] . '<br><br>' .
						'Your password for the student portal is : ' . $random_password . '<br><br>' .
						'Please keep this password safe and <b>do not share</b> it with anyone.<br><br>' .
						'Kindly visit <a href="https://registration.synergycollege2u.com/student_login.php">registration.synergycollege2u.com</a> to change your password.<br><br>'.
						'Thank You<br>';
						
						$mail->send();
						echo "<script>
						window.location.href = 'student_list.php?action=msg_success_add';
						</script>";
					
					 } catch (Exception $e){
						echo '<div class="alert alert-danger">Failed to send email.' . $mail->ErrorInfo . '</div>';
						echo "<script>
						window.location.href = 'new_student.php?id=$_GET[id]&action=msg_fail_add';
						</script>";
					 }
	
                    
                    /*if(isset($_POST['hostel'])){
                        $c_qry = "SELECT * FROM hostel WHERE h_status = 'ACTIVE' and id='".$_POST['hostel']."'";
                        $c_result = mysqli_query($conn, $c_qry);
                        $c_row=mysqli_fetch_array($c_result);
                        $count="select count(id) as count from student_detail where h_id='".$_POST['hostel']."' and s_status='ACTIVE'";
                        $sttr_count=mysqli_query($conn,$count);
                        $result_count=mysqli_fetch_array($sttr_count);
                        $slot=$c_row['slot']-$result_count['count'];
                        if($slot>0){
                            $qey="insert into student_detail(s_id,s_phone,p_name,p_phone,h_id,s_status,pp_name,date_checkin)value('".$id."','".$_POST['hp_contact']."','".$_POST['p_name']."','".$_POST['p_con']."','".$_POST['hostel']."','ACTIVE','".$_POST['pp_name']."','".$_POST['check_in']."')";
                             ;
                            if($sttr=mysqli_query($conn,$qey)){
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
                                window.location.href = 'new_student.php?id=$_GET[id]&action=msg_fail_add2';
                                </script>";
                            }
                        }else{
                            echo "<script>
                            alert('hostel slot is full')
                            window.location.href = 'new_student.php?id=$_GET[id]&action=msg_slotfull_add';
                            </script>";
                        }

                    }else{
                        $qry1 = "UPDATE visitor SET v_register_date='".DATE_TODAY."', s_id='".$id."' WHERE id = '".$_GET['id']."'";
                        if($result1 = mysqli_query($conn, $qry1)){
                            echo "<script>
                            window.location.href = 'student_list.php?action=msg_success_add';
                            </script>";
                        }else{
                            echo "<script>
                            window.location.href = 'new_student.php?id=$_GET[id]&action=msg_fail_add2';
                            </script>";
                        }
                    }*/
                            echo "<script>
                            window.location.href = 'student_list.php?action=msg_success_add';
                            </script>";
                }else{
                    echo "<script>
                    window.location.href = 'new_student.php?id=$_GET[id]&action=msg_fail_add';
                    </script>";
                }
            }
    }else{
		if(isset($_GET['id'])){
			echo "<script>alert('The IC number is repeat')
				window.location.href='new_student.php?id=".$_GET['id']."'
			</script>"; 
		}else{
			echo "<script>alert('The IC number is repeat')
				window.location.href='student_list.php'
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
			$hostel .= ",h_status='YES'";
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
			$date=date("Y-m-d",strtotime("2018-10-17"));
			$qry2="select *, sum(fl.rp_amount) as amo from f_receipt as f inner join f_receipt_detail as fl on fl.r_id=f.id where f.s_id='".$_GET['id']."' and (f.cash_bill_option='Debtor' or f.cash_bill_option='Tuition Fee') and Date(r_date)>='".$date."'";
			$result2=mysqli_query($conn,$qry2);
			$row2=mysqli_fetch_array($result2);
			$qry3="select sum(fl.rp_amount) as amo from f_receipt as f inner join f_receipt_detail as fl on fl.r_id=f.id where f.s_id='".$_GET['id']."' and (f.cash_bill_option='Debtor' or f.cash_bill_option='Tuition Fee' or f.cash_bill_option='Tuition PTPK' or f.cash_bill_option='Deptor PTPK') and Date(r_date)>='".date('2018-12-18')."'";
            $result3=mysqli_query($conn,$qry3);
            $row3=mysqli_fetch_array($result3);
			$_POST['outstanding'];
			$total_left=$row3['amo']+$_POST["l_fee"];
			$total=$row2['amo']+$_POST['outstanding'];
			mysqli_set_charset($conn, 'utf8');
			$qry = "UPDATE student SET file_num='".$_POST['file_no']."' ,birth_sen='".$_POST['b_sen']."' ,month_pay='".$_POST['m_l']."' ,month='".$_POST['t_in']."',outstanding='".$total."'".$semester.",total_pay='".$_POST['t_pay']."' ,tuition_fee_left='".$total_left."' ,s_email='".mysqli_real_escape_string($conn,$_POST['email'])."'
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
			,t_start='$_POST[t_start]',t_end='$_POST[t_end]',date_join='".$_POST['join_date']."',course='".$_POST['course']."'".$new_file.$hostel." ,i_fee='".$_POST['i_fee']."',int_outstanding='$_POST[i_fee]' WHERE id = '".$_GET['id']."'";
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
	$qry = "UPDATE student SET s_status = 'GRADUATE' ,graduated_date='".date('d-m-Y H:i')."',set_by=(select l_name from login where id='".$_SESSION['id']."') WHERE id = '".$_GET['id']."'";
		if($result=mysqli_query($conn, $qry)){
			$select="select * from student where id='".$_GET["id"]."'";
			$sttr=mysqli_query($conn,$select);
			$row=mysqli_fetch_array($sttr);
			$insert_qry="insert into job_tracer(s_name,s_contact,s_ic,i_status) values('$row[s_name]','$row[hp_contact]','$row[ic]','ACTIVE')";
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
	$qry = "UPDATE student SET s_status = 'QUIT', reason_quit = '".$_POST['reason']."', quit_date = '".$_POST['q_date']."' WHERE id = '".$_GET['id']."'";
		if($result = mysqli_query($conn, $qry)){
			echo "<script>
			window.location.href = 'student_list.php?action=msg_success_q';
			</script>";
		}else{
			echo "<script>
			window.location.href = 'student_list.php?action=msg_fail_q';
			</script>";
		}
}

if(isset($_GET['action']) && $_GET['action'] == 'regraduate'){
	$qry = "UPDATE student SET s_status = 'ACTIVE' WHERE id = '".$_GET['id']."'";
		if($result = mysqli_query($conn, $qry)){
			echo "<script>
			window.location.href = 'student_list.php?action=msg_success_reg';
			</script>";
		}else{
			echo "<script>
			window.location.href = 'student_list.php?action=msg_fail_reg';
			</script>";
		}
}

if(isset($_GET['action']) && $_GET['action'] == 'requit'){
	$qry = "UPDATE student SET s_status = 'ACTIVE', reason_quit = '', quit_date = '' WHERE id = '".$_GET['id']."'";
		if($result = mysqli_query($conn, $qry)){
			echo "<script>
			window.location.href = 'student_list.php?action=msg_success_req';
			</script>";
		}else{
			echo "<script>
			window.location.href = 'student_list.php?action=msg_fail_req';
			</script>";
		}
}

?>