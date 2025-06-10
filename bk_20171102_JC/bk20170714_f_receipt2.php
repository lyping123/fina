<?php
require('include/db.php');

if(isset($_POST['submit']) && $_POST['submit'] == 'add'){
	$qry_add = "INSERT INTO f_cart2(c_desc, c_amount, u_id)VALUES('".$_POST['desc']."', '".$_POST['amount']."', '".$_SESSION['id']."')";
	if($result_add = mysqli_query($conn, $qry_add)){
		echo "<script>	
		window.location.href = 'f_receipt_form2.php?action=msg_receipt_success_add';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'f_receipt_form2.php?action=msg_receipt_fail_add';
		</script>";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'delete_receipt'){
	//$qry_add = "UPDATE f_receipt SET r_status='DELETE' WHERE id='".$_GET['id']."'";
	$qry_add = "DELETE FROM f_receipt WHERE id='".$_GET['id']."'";
	if($result_add = mysqli_query($conn, $qry_add)){
		echo "<script>
		window.location.href = 'f_receipt_list2.php?action=msg_receipt_success_del';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'f_receipt_list2.php?action=msg_receipt_fail_del';
		</script>";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
	$qry_add = "DELETE FROM f_cart2 WHERE id='".$_GET['id']."'";
	if($result_add = mysqli_query($conn, $qry_add)){
		echo "<script>
		window.location.href = 'f_receipt_form2.php?action=msg_receipt_success_del';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'f_receipt_form2.php?action=msg_receipt_fail_del';
		</script>";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'clear'){
	$qry_add = "DELETE FROM f_cart2 WHERE u_id = '".$_SESSION['id']."'";
	if($result_add = mysqli_query($conn, $qry_add)){
		echo "<script>
		window.location.href = 'f_receipt_form2.php?action=msg_receipt_success_clear';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'f_receipt_form2.php?action=msg_receipt_fail_clear';
		</script>";
	}
}

if(isset($_POST['submit']) && $_POST['submit'] == 'save'){
	
	$c_qry = "SELECT * FROM f_cart2 WHERE u_id = '".$_SESSION['id']."'";
	$c_result = mysqli_query($conn,$c_qry);
	$c_rows = mysqli_num_rows($c_result);
	if($c_rows > 0){
		$no = 10001;
		$new_no = '';
		
		if(isset($_POST['bankin']) && $_POST['bankin'] == 'bankin'){
			$pay_mtd = $_POST['bankin'];
		}elseif(isset($_POST['cheque']) && $_POST['cheque'] == 'cheque'){
			$pay_mtd = $_POST['cheque'];
		}else{
			$pay_mtd = 'cash';
		}
		
		if(isset($_POST['tuition']) && $_POST['tuition'] == 'tuition'){
			
			$qry_rcp = "SELECT * FROM f_receipt WHERE tuition_fee = 'YES' AND receipt_type = '2'";
			$result_rcp = mysqli_query($conn, $qry_rcp);
			$c_row = mysqli_num_rows($result_rcp);
			$total_no = $no + $c_row;
			$new_no = 'T'.$total_no;
			
			$tuition = 'YES';
		}else{
			$tuition = 'NO';
		}
		
		if(isset($_POST['c_loan']) && $_POST['c_loan'] == 'loan'){
			$loan = 'YES';
		}else{
			$loan = 'NO';
		}
		
		if(isset($_POST['hostel']) && $_POST['hostel'] == 'hostel'){
			
			$qry_rcp = "SELECT * FROM f_receipt WHERE hostel_fee = 'YES' AND receipt_type = '2'";
			$result_rcp = mysqli_query($conn, $qry_rcp);
			$c_row = mysqli_num_rows($result_rcp);
			$total_no = $no + $c_row;
			$new_no = 'H'.$total_no;
			
			$hostel = 'YES';
		}else{
			$hostel = 'NO';
		}
		
		if(isset($_POST['internal']) && $_POST['internal'] == 'internal'){
			
			$qry_rcp = "SELECT * FROM f_receipt WHERE internal_exam_fee = 'YES' AND receipt_type = '2'";
			$result_rcp = mysqli_query($conn, $qry_rcp);
			$c_row = mysqli_num_rows($result_rcp);
			$total_no = $no + $c_row;
			$new_no = 'I'.$total_no;
			
			$internal = 'YES';
		}else{
			$internal = 'NO';
		}
		
		if(isset($_POST['debtor']) && $_POST['debtor'] == 'debtor'){
			
			$qry_rcp = "SELECT * FROM f_receipt WHERE debtor = 'YES' AND receipt_type = '2'";
			$result_rcp = mysqli_query($conn, $qry_rcp);
			$c_row = mysqli_num_rows($result_rcp);
			$total_no = $no + $c_row;
			$new_no = 'D'.$total_no;
			
			$debtor = 'YES';
		}else{
			$debtor = 'NO';
		}
		
		if(isset($_POST['debtor_ptpk']) && $_POST['debtor_ptpk'] == 'debtor_ptpk'){
			
			$qry_rcp = "SELECT * FROM f_receipt WHERE debtor_ptpk = 'YES' AND receipt_type = '2'";
			$result_rcp = mysqli_query($conn, $qry_rcp);
			$c_row = mysqli_num_rows($result_rcp);
			$total_no = $no + $c_row;
			$new_no = 'DP'.$total_no;
			
			$debtor_ptpk = 'YES';
		}else{
			$debtor_ptpk = 'NO';
		}
		
		$qry_save = "INSERT INTO f_receipt(debtor_ptpk,debtor,internal_exam_fee,r_no, r_date, s_name, s_ic, pay_mtd, tuition_fee, ptpk, r_status, createdate, createby, hostel_fee, receipt_type)VALUES('".$debtor_ptpk."', '".$debtor."', '".$internal."', '".$new_no."', '".$_POST['date']."', '".mysqli_real_escape_string($conn,$_POST['name'])."', '".$_POST['ic']."', '".$pay_mtd."', '".$tuition."', '".$loan."', 'ACTIVE', '".DATE_TODAY."', '".$_SESSION['id']."', '".$hostel."', '2')";
		if($result_save = mysqli_query($conn, $qry_save)){
			$r_id = mysqli_insert_id($conn);
			if(isset($_POST['bankin']) && $_POST['bankin'] == 'bankin'){
				$qry_bankin = "INSERT INTO f_b_c(r_id, cheque_no, banker, in_date)VALUES('".$r_id."', 'BANKIN', '".$_POST['bankin_banker']."', '".$_POST['bankin_date']."')";
				if($result_bankin = mysqli_query($conn, $qry_bankin)){
					$qry = "SELECT * FROM f_cart2 WHERE u_id = '".$_SESSION['id']."'";
					$result = mysqli_query($conn, $qry);
					while($row = mysqli_fetch_array($result)){
						$qry_rd = "INSERT INTO f_receipt_detail(r_id, rp_desc, rp_amount)VALUES('".$r_id."', '".$row['c_desc']."', '".$row['c_amount']."')";
						if($result_rd = mysqli_query($conn, $qry_rd)){
							$qry_del = "DELETE FROM f_cart2 WHERE id='".$row['id']."'";
							if($result_del = mysqli_query($conn, $qry_del)){
								/*echo "<script>
									setTimeout(function(){
										window.location.href = 'f_receipt_form.php?action=msg_save';
										window.open('print_receipt.php?&id=$r_id');
									}, 2500); 
								</script>";*/
								echo "<script>
										window.location.href = 'f_choose2.php?action=msg_choose&id=$r_id';
								</script>";
							}else{
								echo "<script>
								window.location.href = 'f_receipt_form2.php?action=msg_bankin_cart_fail_del';
								</script>";
							}
						}else{
							echo "<script>
							window.location.href = 'f_receipt_form2.php?action=msg_bankin_receipt_detail_fail_save';
							</script>";
						}
					}
				}else{
					echo "<script>
					window.location.href = 'f_receipt_form2.php?action=msg_bankin_fail_save';
					</script>";
				}
			}elseif(isset($_POST['cheque']) && $_POST['cheque'] == 'cheque'){
				$qry_cheque = "INSERT INTO f_b_c(r_id, cheque_no, banker, in_date)VALUES('".$r_id."', '".$_POST['c_no']."', '".$_POST['banker']."', '".$_POST['dated']."')";
				if($result_cheque = mysqli_query($conn, $qry_cheque)){
					$qry = "SELECT * FROM f_cart2 WHERE u_id = '".$_SESSION['id']."'";
					$result = mysqli_query($conn, $qry);
					while($row = mysqli_fetch_array($result)){
						$qry_rd = "INSERT INTO f_receipt_detail(r_id, rp_desc, rp_amount)VALUES('".$r_id."', '".$row['c_desc']."', '".$row['c_amount']."')";
						if($result_rd = mysqli_query($conn, $qry_rd)){
							$qry_del = "DELETE FROM f_cart2 WHERE id='".$row['id']."'";
							if($result_del = mysqli_query($conn, $qry_del)){
								/*echo "<script>
									setTimeout(function(){
										window.location.href = 'f_receipt_form.php?action=msg_save';
										window.open('print_receipt.php?&id=$r_id');
									}, 2500);*/
								echo "<script>
										window.location.href = 'f_choose2.php?action=msg_choose&id=$r_id';
								</script>";
							}else{
								echo "<script>
								window.location.href = 'f_receipt_form2.php?action=msg_cheque_cart_fail_del';
								</script>";
							}
						}else{
							echo "<script>
							window.location.href = 'f_receipt_form2.php?action=msg_cheque_receipt_detail_fail_save';
							</script>";
						}
					}
				}else{
					echo "<script>
					window.location.href = 'f_receipt_form2.php?action=msg_cheque_fail_save';
					</script>";
				}
			}else{
				$qry = "SELECT * FROM f_cart2 WHERE u_id = '".$_SESSION['id']."'";
				$result = mysqli_query($conn, $qry);
				while($row = mysqli_fetch_array($result)){
					$qry_rd = "INSERT INTO f_receipt_detail(r_id, rp_desc, rp_amount)VALUES('".$r_id."', '".$row['c_desc']."', '".$row['c_amount']."')";
					if($result_rd = mysqli_query($conn, $qry_rd)){
						$qry_del = "DELETE FROM f_cart2 WHERE id='".$row['id']."'";
						if($result_del = mysqli_query($conn, $qry_del)){
							echo "<script>
									window.location.href = 'f_choose2.php?action=msg_choose&id=$r_id';
							</script>";
						}else{
							echo "<script>
							window.location.href = 'f_receipt_form2.php?action=msg_cart_fail_del';
							</script>";
						}
					}else{
						echo "<script>
						window.location.href = 'f_receipt_form2.php?action=msg_receipt_detail_fail_save';
						</script>";
					}
				}
			}
		}else{
			echo "<script>
			window.location.href = 'f_receipt_form2.php?action=msg_receipt_fail_save';
			</script>";
		}
	}else{
		echo "<script>
		window.location.href = 'f_receipt_form2.php?action=msg_cart_empty';
		</script>";
	}
}
?>