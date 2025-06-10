<?php
require('include/db.php');
if(isset($_POST['submit']) && $_POST['submit'] == 'save'){
	
			mysqli_set_charset($conn, 'utf8');
		    $qry = "INSERT INTO family(s_id,ic,relationship,name,Age,Occupation,qualification,Mobile_no,status,salary)VALUES('".$_GET['id']."','".$_POST["ic"]."','".$_POST['relationship']."','".mysqli_real_escape_string($conn,$_POST['name'])."','".$_POST['age']."','".$_POST['Occupation']."','".$_POST['qualification']."','".$_POST['mobile_no']."','ACTIVE','".$_POST['salary']."')";
			
			//$result = mysqli_query($conn, $qry);
			if($result = mysqli_query($conn, $qry)){
				
				echo "<script>
				window.location.href = 'family.php?action=msg_success_add&id=$_GET[id]';
				</script>";
			}else{
				echo "<script>
				window.location.href = 'family.php?id=$_GET[id]';
				</script>";
			}
		
}

if(isset($_GET['action']) && $_GET['action'] == 'edit'){
	
			mysqli_set_charset($conn, 'utf8');
		    $qry = "UPDATE family SET Name='".$_POST['name']."',ic='".$_POST["ic"]."',Age='".$_POST['age']."',Occupation='".$_POST['Occupation']."',Qualification='".$_POST['qualification']."',Mobile_no='".$_POST['mobile_no']."',Relationship='".$_POST['relationship']."',salary='".$_POST['salary']."' WHERE f_id = '".$_GET['id']."'";
			if($result = mysqli_query($conn, $qry)){
				echo "<script>
				window.location.href = 'family.php?&id=$_GET[s_id]&action=msg_success_edit';
				</script>";
			}else{
				echo "<script>
				window.location.href = 'family_edit.php?id='".$_GET['id']."'&action=msg_fail_edit';
				</script>";
			}
}

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
	   $qry = "UPDATE family SET status = 'DELETE' WHERE f_id = '".$_GET['id']."'";
		if($result = mysqli_query($conn, $qry)){
			echo "<script>
			window.location.href = 'family.php?&id=$_GET[s_id]&action=msg_success_delete';
			</script>";
		}else{
			echo "<script>
			window.location.href = 'family_edit.php?id='".$_GET['id']."'&action=msg_fail_delete';
			</script>";
		}
}

?>