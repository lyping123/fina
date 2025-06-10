<?php 
require ('include/db.php');
require ('include/function.inc.php');

if(isset($_POST['submit']) && $_POST['submit'] == 'apply'){
	/*$pp_qry = "SELECT *, stu.course as new_course FROM student AS stu
               INNER JOIN (SELECT MAX(sg.g_level) AS g_level, sgl.s_id, sg.g_name FROM student_group_list AS sgl
               INNER JOIN student_group AS sg on sg.id = sgl.g_id
               WHERE sgl.status = 'ACTIVE' GROUP BY sgl.s_id) AS sgll ON sgll.s_id = stu.id
	           WHERE stu.id = '".$_SESSION['id']."'";
    $pp_result = mysqli_query($conn, $pp_qry);
    $pp_rows = mysqli_num_rows($pp_result);
    
    if($pp_rows > 0){*/
        $qry = "SELECT * FROM student AS u 
		INNER JOIN student_leave AS sl ON sl.s_id = u.id
		WHERE u.id = '".$_SESSION['id']."'";
        $result = mysqli_query($conn, $qry);
        $row = mysqli_fetch_array($result);


        $qry1 = "SELECT *, SUM(a_days) AS total_apply FROM apply_leave_list WHERE s_id = '".$_SESSION['id']."' AND a_leave_type = 'Leave' AND year(STR_TO_DATE(a_from, '%d-%m-%Y')) = '".YEAR."' AND a_status = 'APPROVAL'";
        $result1 = mysqli_query($conn,$qry1);
        $row1 = mysqli_fetch_array($result1);

        $leave = $row['leave'] - $row1['total_apply'];
        if($leave < $_POST['days'] && $_POST['leave_type'] == 'Leave'){
            echo "<script>
            window.location.href = 'leave_form.php?action=msg_leave_error';
            </script>";
        }else{
            if(!empty($_FILES['img']['name']))
            {
                $ext = explode(".", $_FILES['img']['name']);
                $ext = strtolower(array_pop($ext));
                $file = "img/P".date('YmdHis').'.'.$ext;
                /*$file = $_FILES['image']['name'];*/

                if($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "pdf"){ 
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
            }elseif(isset($target_path) && !move_uploaded_file($_FILES['img']['tmp_name'], $target_path)){
                echo "<script>alert('Photo failed to upload.')</script>";  
            }else{
                $date = explode("-",$_POST['daterange']);
                $new_date = str_replace("/","-",$date);

                $qry = "INSERT INTO apply_leave_list(s_id,a_from,a_to,a_days,a_reason,a_remark,a_leave_type,a_date,a_status,a_photo)VALUES('".$_SESSION['id']."','".$new_date[0]."','".$new_date[1]."','".$_POST['days']."','".mysqli_real_escape_string($conn,$_POST['reason'])."','".mysqli_real_escape_string($conn,$_POST['remark'])."','".$_POST['leave_type']."','".DATE_TODAY."','PENDING','".$file."')";
                if($result = mysqli_query($conn, $qry)){
                        echo "<script>
                              window.location.href = 'leave_form.php?action=msg_success_add';
                              </script>";

                    /*$sal_id=mysqli_insert_id($conn);

                    require_once('PHPMailer/class.phpmailer.php');
                    require_once('PHPMailer/function_user.php');

                    //$to = "engwei333@hotmail.com";
                    $to = "sysynergy@hotmail.com";
                    //$to = "gvta_25@yahoo.com.my";
                    $to_name = "Synergy Admin";
                    $from_name = $_SESSION['name'];
                    $subject = "Request Leave";
                    $message = nl2br("Name: $_SESSION[name] \r\n
                                      Apply For $_POST[days] days $_POST[leave_type] Leave\r\n
                                      From : $new_date[0] \r\n
                                      To: $new_date[1] \r\n
                                      Reason: $_POST[reason] \r\n
                                      *Remark: $_POST[remark] \r\n
                                      Clicking the following link : <a href='http://leave-application.jom-jom.com/admin/index.php?id=$sal_id&years=YEAR'>http://leave-application.jom-jom.com/admin/index.php?id=$sal_id&years=YEAR</a> to approval or reject the leave \r\n");

                    $header = "From: $_SESSION[name]";

                    if($send=sendEmail($to,$to_name,$from_name,$subject,$message,$header)){
                        echo "<script>
                              window.location.href = 'leave_form.php?action=msg_success_add';
                              </script>";
                    }else{
                        echo "<script>
                              window.location.href = 'leave_form.php?action=msg_fail_send';
                              </script>";
                    }*/

                }else{
                    echo "<script>
                    window.location.href = 'leave_form.php?action=msg_fail_add';
                    </script>";

                }
            }
        }
    /*}
    else{
        echo "<script>
        window.location.href = 'leave_form.php?action=msg_empty_pp';
        </script>";
    }*/
}


if(isset($_POST['submit']) && $_POST['submit'] == 'update'){
	
	if(isset($_POST['fh']) && $_POST['fh'] == 'Half Day'){
		if($_POST['boal'] == 'before'){
			$from = $_POST['date'].' 08:00:00';
			$too = $_POST['date'].' 12:00:00';
		}elseif($_POST['boal'] == 'after'){
			$from = $_POST['date'].' 13:00:00';
			$too = $_POST['date'].' 17:00:00';
		}
		$qry = "UPDATE apply_leave_list SET a_reason='".$_POST['reason']."', a_remark='".$_POST['remark']."', a_date='".DATE_TODAY."', a_status='PENDING', a_from='".$from."', a_to='".$too."', a_leave_type='".$_POST['leave_type']."'  WHERE id = '".$_GET['id']."'";
		if($result = mysqli_query($conn, $qry)){
				echo "<script>
					  window.location.href = 'edit_leave.php?id=$_GET[id]&action=msg_success_update';
					  </script>";
			
			/*require_once('../PHPMailer/class.phpmailer.php');
			require_once('../PHPMailer/function_user.php');
			
			$to = "sysynergy@hotmail.com";
			//$to = "engwei333@hotmail.com";
			//$to = "gvta_25@yahoo.com.my";
			$to_name = "Synergy Admin";
			$from_name = $_SESSION['name'];
			$subject = "Update Request Leave";
			$message = nl2br("Update Leave\r\n
							  Name: $_SESSION[name] \r\n
							  Apply For 0.5 days $_POST[leave_type] Leave\r\n
							  From : $from \r\n
							  To: $too \r\n
							  Reason: $_POST[reason] \r\n
							  *Remark: $_POST[remark] \r\n
							  Clicking the following link : <a href='http://leave-application.jom-jom.com/admin/index.php?id=$_GET[id]&years=YEAR'>http://leave-application.jom-jom.com/admin/index.php?id=$_GET[id]&years=YEAR</a> to approval or reject the leave \r\n");
			
			$header = "From: $_SESSION[name]";
		
			if($send=sendEmail($to,$to_name,$from_name,$subject,$message,$header)){
				echo "<script>
					  window.location.href = 'edit_leave.php?id=$_GET[id]&action=msg_success_update';
					  </script>";
			}else{
				echo "<script>
					  window.location.href = 'edit_leave.php?id=$_GET[id]&action=msg_fail_send';
					  </script>";
			}*/
			
		}else{
			echo "<script>
			window.location.href = 'edit_leave.php?id=$_GET[id]&action=msg_fail_update';
			</script>";
			
		}
	}else{
		
if(!empty($_FILES['img']['name']))
	{
		$ext = explode(".", $_FILES['img']['name']);
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
	}elseif(isset($target_path) && !move_uploaded_file($_FILES['img']['tmp_name'], $target_path)){
		echo "<script>alert('Photo failed to upload.')</script>";  
    }else{
		
		if($_POST['leave_type'] == 'Medical' && !empty($file )){
			$img = ", a_photo='".$file."'";
		}else{
			$img = "";
		}
		
		$date = explode("-",$_POST['daterange']);
		$new_date = str_replace("/","-",$date);
		
		$qry = "UPDATE apply_leave_list SET a_days='".$_POST['days']."', a_reason='".$_POST['reason']."', a_remark='".$_POST['remark']."', a_date='".DATE_TODAY."', a_status='PENDING', a_leave_type='".$_POST['leave_type']."', a_from='".$new_date[0]."', a_to='".$new_date[1]."'".$img." WHERE id = '".$_GET['id']."'";
		if($result = mysqli_query($conn, $qry)){
				echo "<script>
					  window.location.href = 'edit_leave.php?id=$_GET[id]&action=msg_success_update';
					  </script>";
			
			/*require_once('../PHPMailer/class.phpmailer.php');
			require_once('../PHPMailer/function_user.php');
			
			$to = "sysynergy@hotmail.com";
			//$to = "engwei333@hotmail.com";
			//$to = "gvta_25@yahoo.com.my";
			$to_name = "Synergy Admin";
			$from_name = $_SESSION['name'];
			$subject = "Update Request Leave";
			$message = nl2br("Update Leave\r\n
							  Name: $_SESSION[name] \r\n
							  Apply For $_POST[days] days $_POST[leave_type] Leave\r\n
							  From : $new_date[0] \r\n
							  To: $new_date[1] \r\n
							  Reason: $_POST[reason] \r\n
							  *Remark: $_POST[remark] \r\n
							  Clicking the following link : <a href='http://leave-application.jom-jom.com/admin/index.php?id=$_GET[id]&years=YEAR'>http://leave-application.jom-jom.com/admin/index.php?id=$_GET[id]&years=YEAR</a> to approval or reject the leave \r\n");
			
			$header = "From: $_SESSION[name]";
		
			if($send=sendEmail($to,$to_name,$from_name,$subject,$message,$header)){
				echo "<script>
					  window.location.href = 'edit_leave.php?id=$_GET[id]&action=msg_success_update';
					  </script>";
			}else{
				echo "<script>
					  window.location.href = 'edit_leave.php?id=$_GET[id]&action=msg_fail_send';
					  </script>";
			}*/
			
		}else{
			echo "<script>
			window.location.href = 'edit_leave.php?id=$_GET[id]&action=msg_fail_update';
			</script>";
			
		}
	}
	}
}


if(isset($_GET['action']) && $_GET['action'] == 'delete'){
	$query="DELETE FROM apply_leave_list WHERE id = '".$_GET['id']."'";
	if($sql=mysqli_query($conn,$query)){
        echo "<script>
              window.location.href = 'summary.php';
              alert('Successfully Delete Leave.')
              </script>";
	}else{
		echo "<script>
			  window.location.href = 'summary.php';
			  alert('Fails to Delete Leave.')
			  </script>";
	}
} 
?>