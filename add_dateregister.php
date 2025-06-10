<?php
require('include/db.php');
if(isset($_POST['submit']) && $_POST['submit'] == 'save_date'){
	
			mysqli_set_charset($conn, 'utf8');
	        $qry = "INSERT INTO date_register(s_id,level,register_date,exam_date,status)VALUES('".$_GET['id']."','".$_POST['level']."','".$_POST['r_date']."','".$_POST['exam_date']."','ACTIVE')";
		
			//$result = mysqli_query($conn, $qry);
			if($result = mysqli_query($conn, $qry)){
				
				echo "<script>
				window.location.href = 'dateregister.php?&id=$_GET[id]&action=msg_success_add';
				</script>";
			}else{
				echo "<script>
				window.location.href = 'dateregister.php?&id=$_GET[id]&action=msg_fail_add';
				</script>";
			}
		
}

if(isset($_POST['submit']) && $_POST['submit'] == 'edit_date'){
	
			mysqli_set_charset($conn, 'utf8');
		    $qry = "UPDATE date_register SET level='".$_POST['level']."',register_date='".$_POST['r_date']."',exam_date='".$_POST['exam_date']."' WHERE id = '".$_GET['sid']."'";
		
			if($result = mysqli_query($conn, $qry)){
				echo "<script>
				window.location.href = 'dateregister.php?&id=$_GET[id]&action=msg_success_edit';
				</script>";
			}else{
				echo "<script>
				window.location.href = 'dateregister.php?&id=$_GET[id]&action=msg_fail_edit';
				</script>";
			}
}
if(isset($_GET['action']) && $_GET['action'] == 'delete_date'){
	 $qry = "UPDATE date_register SET status = 'DELETE' WHERE id = '".$_GET['sid']."'";
		if($result2 = mysqli_query($conn, $qry)){
			echo "<script>
			window.location.href = 'dateregister.php?&id=$_GET[id]&action=msg_success_delete';
			</script>";
		}else{
			echo "<script>
			window.location.href = 'dateregister.php?id=$_GET[id]&action=msg_fail_delete';
			</script>";
		}
}
?>