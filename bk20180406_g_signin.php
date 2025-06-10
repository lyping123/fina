<?php
require('include/db.php');

if(isset($_POST['submit']) && $_POST['submit'] == 'add'){
	 $qry1 = "SELECT * FROM student_group AS sg 
			INNER JOIN course AS c ON c.id = sg.c_id
			WHERE sg.id = '".$_GET['group']."'";
	$result1 = mysqli_query($conn, $qry1);
	$row1 = mysqli_fetch_array($result1);
	
	/* $select_level="select * from student where g_id<>''";
	$sttr_level=mysqli_query($conn,$select_level);
	
	while($result_level=mysqli_fetch_array($sttr_level)){
		$sttr_uplevel=mysqli_query($conn,"update student set s_level=(select sg.g_level from student_group as sg inner join student_group_list as sgl on sgl.g_id=sg.id where sgl.s_id='".$result_level['id']."') where id='".$result_level['id']."'");
		
	}*/
	$date=date('d-m-Y');
	
	$qry = "INSERT INTO student_group_list(g_id,s_id,status,file_name)VALUES('".$_GET['group']."', '".$_POST['name']."', 'ACTIVE', '".$_POST['fname']."')";
	
	if($result = mysqli_query($conn, $qry)){
		if($row1['g_level']==4 && ($row1['c_id']==1||$row1['c_id']==4)){
			$amo=150;
		}
		else{
			$amo=100;
		}
		$query_g="select * from student_group where id='".$_GET['group']."'";
		$sttr_g=mysqli_query($conn,$query_g);
		$result_g=mysqli_fetch_array($sttr_g);
		  $qry_hos="insert into internal_fee(s_id,s_level,amount,date_join,pay_status)values('".$_POST['name']."','".$row1['g_level']."','$amo','".$result_g['end_date']."','NO')";
		$sttr_hos=mysqli_query($conn,$qry_hos);
		$query="update student set s_level='".$row1['g_level']."'where id='".$_POST['name']."'";
		$sttr=mysqli_query($conn,$query);
		if($row1['g_level'] == '2' || $row1['g_level'] == 'Single Tier'){
			$qry2 = "UPDATE student SET course = '".$row1['course']."' WHERE id = '".$_POST['name']."'";
			
			if($result2 = mysqli_query($conn, $qry2)){
				echo "<script>
				window.location.href = 'g_signin_list.php?action=msg_success_add&id=$_GET[group]';
				</script>";
			}else{
				echo "<script>
				window.location.href = 'g_signin_list.php?action=msg_fail_update&id=$_GET[group]';
				</script>";
			}
		}else{
			echo "<script>
			window.location.href = 'g_signin_list.php?action=msg_success_add&id=$_GET[group]';
			</script>";
		}
	}else{
		echo "<script>
		window.location.href = 'g_signin_list.php?action=msg_fail_add&id=$_GET[group]';
		</script>";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'update'){
	$qry = "UPDATE student_group_list SET file_name = '".$_POST['fname']."' WHERE id = '".$_GET['id']."'";
		if($result = mysqli_query($conn, $qry)){
			echo "<script>
			window.location.href = 'g_signin_list.php?action=msg_success_edit&id=$_GET[group]';
			</script>";
		}else{
			echo "<script>
			window.location.href = 'g_signin_list.php?action=msg_fail_edit&id=$_GET[group]';
			</script>";
		}
}

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
	$qry = "UPDATE student_group_list SET status = 'DELETE' WHERE id = '".$_GET['id']."'";
		if($result = mysqli_query($conn, $qry)){
			$delete="update internal_fee set pay_status='DELETE'";
			$sttr_d=mysqli_query($conn,$delete);
			
			echo "<script>
			window.location.href = 'g_signin_list.php?action=msg_success_del&id=$_GET[group]';
			</script>";
		}else{
			echo "<script>
			window.location.href = 'g_signin_list.php?action=msg_fail_del&id=$_GET[group]';
			</script>";
		}
}
?>