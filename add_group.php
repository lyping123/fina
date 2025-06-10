<?php
require('include/db.php');
if(isset($_POST['submit']) && $_POST['submit'] == 'save'){
	$c_qry = "SELECT * FROM login WHERE id = '".$_POST['pp']."'";
	$c_result = mysqli_query($conn,$c_qry);
	$c_row = mysqli_fetch_array($c_result);
	
	$qry = "INSERT INTO student_group(c_id,g_name,g_status,g_level,p_id,jpk_pp_id,start_date,end_date)VALUES('".mysqli_real_escape_string($conn,$_POST['course'])."','".mysqli_real_escape_string($conn,$_POST['gname'])."','ACTIVE','".$_POST['level']."','".$_POST['pp']."','".$_POST['jpkpp']."','".$_POST['sd']."','".$_POST['ed']."')";
	//$result = mysqli_query($conn, $qry);

	
	if($result = mysqli_query($conn, $qry)){
		$last_id=mysqli_insert_id($conn);
		if($_POST["level"]==4){
			$qry_re="insert into reminder(g_id,date_remind,g_status,lvl) values('$last_id','$_POST[date_lv1]','ACTIVE','$_POST[level]')";
		}else if($_POST["level"]=="Single Tier"){
			$qry_re="insert into reminder(g_id,date_remind,g_status,lvl) values('$last_id','$_POST[date_lv2]','ACTIVE','$_POST[level]'),('$last_id','$_POST[date_lv3]','ACTIVE','$_POST[level]'),('$last_id','$_POST[date_lv4]','ACTIVE','$_POST[level]')";
		}else{
			$qry_re="";
		}
		$qry_re;
		$sttr_re=mysqli_query($conn,$qry_re);
		echo "<script>
		window.location.href = 'add_group_form.php?action=msg_success_add';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'add_group_form.php?action=msg_fail_add';
		</script>";
	}
}
if(isset($_GET['action']) && $_GET['action'] == 'edit'){
	
		$array=$_POST["semester_type"];
		$startdate=$_POST["startdate"];
		$enddate=$_POST["enddate"];
		$sql="";
		$count=count($array);
		for($i=0;$i<$count;$i++){
			$sql[]="('".$_GET["id"]."','$array[$i]','$startdate[$i]','$enddate[$i]')";
		}
		$new_sql=implode(",",$sql);
		$qry1="insert into semester_break(g_id,break_type,break_date,break_date_to) values".$new_sql;	
		$sttr=mysqli_query($conn,$qry1);
	
	$split1=explode('-',$_POST["daterange"]);
	$split2=explode('-',$_POST["daterange1"]);
	
	// $sexam2=date("Y-m-d", strtotime($split1[0]));
	// $eexam2=date("Y-m-d", strtotime($split1[1]));  
	// $sexam3=date("Y-m-d", strtotime($split2[0]));  
	// $eexam3=date("Y-m-d", strtotime($split2[1]));  
	
	$qry = "UPDATE student_group SET c_id = '".mysqli_real_escape_string($conn,$_POST['course'])."', g_name = '".mysqli_real_escape_string($conn,$_POST['gname'])."'
	, g_status = 'ACTIVE', g_level = '".$_POST['level']."', p_id = '".$_POST['pp']."'
	, jpk_pp_id = '".$_POST['jpkpp']."', start_date = '".$_POST['sd']."'
	, end_date = '".$_POST['ed']."',exam2_sdate='$split1[0]',exam2_edate='$split1[1]',exam3_sdate='$split2[0]',exam3_edate='$split2[1]' WHERE id = '".$_GET['id']."'";
	if($result = mysqli_query($conn, $qry)){
		echo "<script>
		window.location.href = 'edit_group.php?action=msg_success_edit&id=$_GET[id]';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'edit_group.php?action=msg_fail_edit&id=$_GET[id]';
		</script>";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
	$qry = "UPDATE student_group SET g_status = 'DELETE' WHERE id = '".$_GET['id']."'";
		if($result = mysqli_query($conn, $qry)){
			echo "<script>
			window.location.href = 'group_list.php?action=msg_success_del';
			</script>";
		}else{
			echo "<script>
			window.location.href = 'group_list.php?action=msg_fail_del';
			</script>";
		}
}
if(isset($_POST['submit_upload'])){
	if($_FILES["file"]["name"]!==""){
		$doc=explode(".",$_FILES["file"]["name"]);
		$ext = strtolower(array_pop($doc));
		$file = "files/F".date('YmdHis').'.'.$ext;
	}
	if(isset($file) && !move_uploaded_file($_FILES['file']['tmp_name'], $file)){
		echo "<script>alert('File failed to upload.');window.location.href='semester_break.php'</script>"; 
	}else{
		$qry = "UPDATE student_group SET sb_doc = '$file'  WHERE id = '".$_GET['id']."'";
		if($result = mysqli_query($conn, $qry)){
			echo "<script>
			window.location.href = 'semester_break.php?action=msg_success_up';
			</script>";
		}else{
			echo "<script>
			window.location.href = 'semester_break.php?action=msg_fail_up';
			</script>";
		}
	}
	
}
	
?>