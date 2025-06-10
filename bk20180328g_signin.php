<?php
require('include/db.php');

if(isset($_POST['submit']) && $_POST['submit'] == 'add'){
	$qry1 = "SELECT * FROM student_group AS sg 
			INNER JOIN course AS c ON c.id = sg.c_id
			WHERE sg.id = '".$_GET['group']."'";
	$result1 = mysqli_query($conn, $qry1);
	$row1 = mysqli_fetch_array($result1);
	
    if(isset($_POST['loan']) && $_POST['loan'] == 'Penanguhan'){
        $loan = ", '".$_POST['loan']."', '".$_POST['bdn']."', '".$_POST['bdd']."', '".$_POST['amount']."'";
    }else{
        $loan = ",'".$_POST['loan']."', '', '', ''";
    }
    
	$qry = "INSERT INTO student_group_list(g_id,s_id,status,file_name,payment_type,bank_draf_no,bank_draf_date,amount)VALUES('".$_GET['group']."', '".$_POST['name']."', 'ACTIVE', '".$_POST['fname']."'".$loan.")";
	if($result = mysqli_query($conn, $qry)){
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
	$qry = "UPDATE student_group_list SET file_name = '".$_POST['file_name']."', payment_type = '".$_POST['payment_type']."', bank_draf_no = '".$_POST['bank_draf_no']."', bank_draf_date = '".$_POST['bank_draf_date']."', amount = '".$_POST['amount']."' WHERE id = '".$_GET['id']."'";
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