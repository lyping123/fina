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
        if($row1['g_level']==4 && ($row1['c_id']==1||$row1['c_id']==4)){
			$amo=150;
		}
		else{
			$amo=100;
		}
		
        $qry_hos="update student set internel_fee='".$amo."', outstanding='".$amo."' where id='".$_POST['name']."'";
		$sttr_hos=mysqli_query($conn,$qry_hos);
		$sel=mysqli_query($conn,"select month_pay from student where id='".$_POST["name"]."'");
		$pay=mysqli_fetch_array($sel);
		if($row1['g_level']=='2'){
			if($row1['c_id']== 3 || $row1['c_id']== 5){
				$month=6;
			}else{
				$month=0;
			}
		}
		elseif($row1['g_level']=='3'){
			if($row1['c_id']== 5){
				$month=9;
			}else{
				$month=12;
			}
		}elseif($row1['g_level']=='4' || $row1['g_level']=='Single Tier' ){
			if($row1['c_id']== 3 || $row1['c_id']== 4){
				$month=12;
			}else{
				$month=15;
			}
		}else{
			$month=15;
		}
		$left=$month-$pay;
		if($left<=0){
			$qry_month="update student set month='".$month."',month_pay=0 where id='".$_POST['name']."'";
			$sttr_month=mysqli_query($conn,$qry_month);
		}else{
			$qry_month="update student set month='".$month."',month_pay='".$pay."' where id='".$_POST['name']."'";
			$sttr_month=mysqli_query($conn,$qry_month);
		}
		
		
		//$result_month=mysqli_query($conn,$qry_month);
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