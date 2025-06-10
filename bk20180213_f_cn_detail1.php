<?php
require('include/db.php');

if(isset($_POST['submit']) && $_POST['submit'] == 'add'){
	$qry_add = "INSERT INTO f_cn_detail(cn_id, cn_desc, cn_amount)VALUES('".$_GET['id']."', '".$_POST['desc']."', '".$_POST['amount']."')";
	if($result_add = mysqli_query($conn, $qry_add)){
		echo "<script>	
		window.location.href = 'f_cn_edit1.php?action=msg_receipt_success_add&id=$_GET[id]';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'f_cn_edit1.php?action=msg_receipt_fail_add&id=$_GET[id]';
		</script>";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
	$qry_add = "DELETE FROM f_cn_detail WHERE id='".$_GET['id']."'";
	if($result_add = mysqli_query($conn, $qry_add)){
		echo "<script>
		window.location.href = 'f_cn_edit1.php?action=msg_receipt_success_del&id=$_GET[r_id]';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'f_cn_edit1.php?action=msg_receipt_fail_del&id=$_GET[r_id]';
		</script>";
	}
}
?>