<?php
require('include/db.php');

if(isset($_POST['submit']) && $_POST['submit'] == 'save_school'){
	
			mysqli_set_charset($conn, 'utf8');
	        $qry = "INSERT INTO school(s_ic,name_school,location,qualification,year,status,former)VALUES('".$_GET['sic']."','".$_POST['schoolList']."','".$_POST['location']."','".$_POST['qualification']."','".$_POST['year']."','ACTIVE','".$_POST['former']."')";
		
			//$result = mysqli_query($conn, $qry);
			if($result = mysqli_query($conn, $qry)){
				
				echo "<script>
				window.location.href = 'v_quanlification.php?&id=$_GET[id]&action=msg_success_add';
				</script>";
			}else{
				echo "<script>
				window.location.href = 'v_quanlification.php?&id=$_GET[id]&action=msg_fail_add';
				</script>";
			}
		
}

if(isset($_POST['submit']) && $_POST['submit'] == 'save_result'){
	
			mysqli_set_charset($conn, 'utf8');
		    $qry = "INSERT INTO result(s_ic,syllabus,result)VALUES('".$_GET['sic']."','".$_POST['syllabus']."','".$_POST['result']."')";
			
			//$result = mysqli_query($conn, $qry);
			if($result = mysqli_query($conn, $qry)){
				
				echo "<script>
				window.location.href = 'v_quanlification.php?&id=$_GET[id]&action=msg_success_add';
				</script>";
			}else{
				echo "<script>
				window.location.href = 'v_quanlification.php?&id=$_GET[id]&action=msg_fail_add';
				</script>";
			}
		
}

if(isset($_POST['submit']) && $_POST['submit'] == 'edit_school'){
	
			mysqli_set_charset($conn, 'utf8');
		    $qry = "UPDATE school SET name_school='".$_POST['schoolList']."',location='".$_POST['location']."',qualification='".$_POST['qualification']."',year='".$_POST['year']."',former='".$_POST['former']."' WHERE s_ic = '".$_GET['sic']."'";
		
			if($result = mysqli_query($conn, $qry)){
				echo "<script>
				window.location.href = 'v_quanlification.php?&id=$_GET[id]&action=msg_success_edit';
				</script>";
			}else{
				echo "<script>
				window.location.href = 'v_quanlification.php?&id=$_GET[id]&action=msg_fail_edit';
				</script>";
			}
}
if(isset($_GET['action']) && $_GET['action'] == 'edit_result'){
	
			mysqli_set_charset($conn, 'utf8');
		    $qry = "UPDATE result SET syllabus='".$_POST['syllabus']."',result='".$_POST['result']."' WHERE s_ic = '".$_GET['sic']."'";
		
			if($result = mysqli_query($conn, $qry)){
				echo "<script>
				window.location.href = 'v_quanlification.php?&id=$_GET[id]&action=msg_success_edit';
				</script>";
			}else{
				echo "<script>
				window.location.href = 'v_quanlification.php?&id=$_GET[id]&action=msg_fail_edit';
				</script>";
			}
}
if(isset($_GET['action']) && $_GET['action'] == 'delete_school'){
	 $qry = "UPDATE school SET status = 'DELETE' WHERE s_ic = '".$_GET['sic']."'";
	
		if($result2 = mysqli_query($conn, $qry)){
			echo "<script>
			window.location.href = 'v_quanlification.php?&id=$_GET[id]&action=msg_success_delete';
			</script>";
		}else{
			echo "<script>
			window.location.href = 'v_quanlification.php?id=$_GET[id]&action=msg_fail_delete';
			</script>";
		}
}
if(isset($_GET['action']) && $_GET['action'] == 'delete_result'){
	 $qry = "DELETE FROM result WHERE s_ic = '".$_GET['sic']."'";
		if($result = mysqli_query($conn, $qry)){
			echo "<script>
			window.location.href = 'v_quanlification.php?&id=$_GET[id]&action=msg_success_delete';
			</script>";
		}else{
			echo "<script>
			window.location.href = 'v_quanlification.php?&id=$_GET[id]&action=msg_fail_delete';
			</script>";
		}
}
?>