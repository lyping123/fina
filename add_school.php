<?php 
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add new school.');
}/*elseif(isset($_GET['action']) && $_GET['action'] == 'msg_limit'){
	$system_msg .= systemMsg('alert-warning','Warning!','1 PP cannot have more than 25 student');
}*/
?>
    <!-- Page Content -->
    <div class="container">
<?php 
//add school
if(isset($_POST['submit']) && $_POST['submit'] == 'save_school'){
			mysqli_set_charset($conn, 'utf8');
	        $qry = "INSERT INTO school_list(name_school,status)VALUES('".$_POST['school']."','ACTIVE')";
		
			//$result = mysqli_query($conn, $qry);
			if($result = mysqli_query($conn, $qry)){
				
				echo "<script>
				window.location.href = 'school_list.php?&action=msg_success_add';
				</script>";
			}else{
				echo "<script>
				window.location.href = 'school_list.php?&action=msg_fail_add';
				</script>";
			}
}
?>
<?php 
if(isset($_POST['submit']) && $_POST['submit'] == 'edit_school'){
//edit school	
			mysqli_set_charset($conn, 'utf8');
		    $qry = "UPDATE school_list SET name_school='".$_POST['school']."' WHERE id = '".$_GET['id']."'";
	
			if($result = mysqli_query($conn, $qry)){
				echo "<script>
				window.location.href = 'school_list.php?&id=$_GET[id]&action=msg_success_edit';
				</script>";
			}else{
				echo "<script>
				window.location.href = 'school_list.php?&id=$_GET[id]&action=msg_fail_edit';
				</script>";
			}
}

if(isset($_GET['action']) && $_GET['action'] == 'delete_school'){
	//Delete school
	 $qry = "UPDATE school_list SET status = 'DELETE' WHERE id = '".$_GET['id']."'";
	 		echo $qry;
			
		if($result2 = mysqli_query($conn, $qry)){
			echo "<script>
			window.location.href = 'school_list.php?&id=$_POST[id]&action=msg_success_delete';
			</script>";
		}else{
			echo "<script>
			window.location.href = 'school_list.php?id=$_POST[id]&action=msg_fail_delete';
			</script>";
		}
}
?>  


        <div class="row">
        

        <!-- /.row -->
<?php require('footer.php');?>