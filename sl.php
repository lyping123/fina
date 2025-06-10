<?php
require('include/db.php');

if(isset($_GET['action']) && $_GET['action'] == 'editleave'){
	$qry="SELECT * FROM student_leave WHERE s_id = '".$_GET['id']."'";
	$result = mysqli_query($conn,$qry);
	$rows = mysqli_num_rows($result);
	$row = mysqli_fetch_array($result);
	if($rows==1){
		/*$qry2 = "UPDATE student_leave SET `leave`='".$_POST['leave']."', medical='".$_POST['medical']."', emergency='".$_POST['emergency']."', parental='".$_POST['parental']."' WHERE id = '".$row['id']."'";*/
		$qry2 = "UPDATE student_leave SET `leave`='".$_POST['leave']."' WHERE id = '".$row['id']."'";
        if($result2 = mysqli_query($conn,$qry2)){
            echo "<script>
            window.location.href = 'sl_form.php?action=msg_edit_success&id=$_GET[id]';
            </script>";
        }else{
            echo "<script>
            window.location.href = 'sl_form.php?action=msg_edit_fail&id=$_GET[id]';
            </script>";
        }
	}else{			
		/*$qry2 = "INSERT INTO student_leave(s_id,`leave`,medical,emergency,parental)VALUES('".$_GET['id']."','".$_POST['leave']."','".$_POST['medical']."','".$_POST['emergency']."','".$_POST['parental']."')";*/
		$qry2 = "INSERT INTO student_leave(s_id,`leave`)VALUES('".$_GET['id']."','".$_POST['leave']."')";
        if($result2 = mysqli_query($conn,$qry2)){
            echo "<script>
            window.location.href = 'sl_form.php?action=msg_edit_success&id=$_GET[id]';
            </script>";
        }else{
            echo "<script>
            window.location.href = 'sl_form.php?action=msg_edit_fail&id=$_GET[id]';
            </script>";
        }
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
    $qry2 = "UPDATE apply_leave_list SET a_status = 'DELETE' WHERE id = '".$_GET['id']."'";
    if($result2 = mysqli_query($conn,$qry2)){
        echo "<script>
        window.location.href = 'studentapplyleavelist.php?action=msg_del_success';
        </script>";
    }else{
        echo "<script>
        window.location.href = 'studentapplyleavelist.php?action=msg_del_fail';
        </script>";
    }
}

if(isset($_GET['action']) && $_GET['action'] == 'approve'){
    if($_SESSION['dp'] == 'Department Lecturer'){
        $status = 'SUPPORT';
    }else{
        $status = 'APPROVAL';
    }
		
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
        if(!empty($_POST['photo'])){
            $file = $_POST['photo'];
        }else{
            $file = '';
        }
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
        
        $qry2 = "UPDATE apply_leave_list SET a_status = '".$status."', a_days='".$_POST['days']."', a_reason='".$_POST['reason']."', a_remark='".$_POST['remark']."', a_leave_type='".$_POST['leave_type']."', a_from='".$new_date[0]."', a_to='".$new_date[1]."', a_photo='".$file."' WHERE id = '".$_GET['id']."'";
        if($result2 = mysqli_query($conn,$qry2)){
            echo "<script>
            window.location.href = 'admin_leave_form.php?action=msg_update_success&id=$_GET[id]';
            </script>";
        }else{
            echo "<script>
            window.location.href = 'admin_leave_form.php?action=msg_update_fail&id=$_GET[id]'';
            </script>";
        }
    }
}

if(isset($_GET['action']) && $_GET['action'] == 'reject'){
    $qry2 = "UPDATE apply_leave_list SET a_status = 'REJECT' WHERE id = '".$_GET['id']."'";
    if($result2 = mysqli_query($conn,$qry2)){
        echo "<script>
        window.location.href = 'admin_leave_form.php?action=msg_reject_success&id=$_GET[id]';
        </script>";
    }else{
        echo "<script>
        window.location.href = 'admin_leave_form.php?action=msg_reject_fail&id=$_GET[id]'';
        </script>";
    }
}

if(isset($_POST['submit']) && $_POST['submit'] == 'apply'){
    if($_SESSION['dp'] == 'Department Lecturer'){
        $status = 'SUPPORT';
    }else{
        $status = 'APPROVAL';
    }
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
        $date = explode("-",$_POST['daterange']);
        $new_date = str_replace("/","-",$date);

        $qry = "INSERT INTO apply_leave_list(s_id,a_from,a_to,a_days,a_reason,a_remark,a_leave_type,a_date,a_status,a_photo)VALUES('".$_POST['name']."','".$new_date[0]."','".$new_date[1]."','".$_POST['days']."','".$_POST['reason']."','".$_POST['remark']."','".$_POST['leave_type']."','".DATE_TODAY."','".$status."','".$file."')";
        if($result = mysqli_query($conn, $qry)){
                echo "<script>
                      window.location.href = 'admin_applyleave_form.php?action=msg_success_add';
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
            window.location.href = 'admin_applyleave_form.php?action=msg_fail_add';
            </script>";

        }
    }
}
?>