<?php
require('include/db.php');

if(isset($_POST['submit']) && $_POST['submit'] == 'add'){
	$qry_add = "INSERT INTO f_cn_cart(c_desc, c_amount, u_id)VALUES('".$_POST['desc']."', '".$_POST['amount']."', '".$_SESSION['id']."')";
	if($result_add = mysqli_query($conn, $qry_add)){
		echo "<script>	
		window.location.href = 'f_cn_form1.php?action=msg_receipt_success_add';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'f_cn_form1.php?action=msg_receipt_fail_add';
		</script>";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'delete_receipt'){
	//$qry_add = "UPDATE f_cn SET cn_status='DELETE' WHERE id='".$_GET['id']."'";
	$qry_add = "DELETE FROM f_cn WHERE id='".$_GET['id']."'";
	if($result_add = mysqli_query($conn, $qry_add)){
		echo "<script>
		window.location.href = 'f_cn_list1.php?action=msg_receipt_success_del';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'f_cn_list1.php?action=msg_receipt_fail_del';
		</script>";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
	$qry_add = "DELETE FROM f_cn_cart WHERE id='".$_GET['id']."'";
	if($result_add = mysqli_query($conn, $qry_add)){
		echo "<script>
		window.location.href = 'f_cn_form1.php?action=msg_receipt_success_del';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'f_cn_form1.php?action=msg_receipt_fail_del';
		</script>";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'clear'){
	$qry_add = "DELETE FROM f_cn_cart WHERE u_id = '".$_SESSION['id']."'";
	if($result_add = mysqli_query($conn, $qry_add)){
		echo "<script>
		window.location.href = 'f_cn_form1.php?action=msg_receipt_success_clear';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'f_cn_form1.php?action=msg_receipt_fail_clear';
		</script>";
	}
}

if(isset($_POST['submit']) && $_POST['submit'] == 'save'){
	
	$c_qry = "SELECT * FROM f_cn_cart WHERE u_id='".$_SESSION['id']."'";
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
		
		if(isset($_POST['c_loan']) && $_POST['c_loan'] == 'loan'){
			$loan = 'YES';
		}else{
			$loan = 'NO';
		}
		
		$qry_rcp = "SELECT * FROM f_cn WHERE debtor = 'YES' AND receipt_type = '1'";
		$result_rcp = mysqli_query($conn, $qry_rcp);
		$c_row = mysqli_num_rows($result_rcp);
		$total_no = $no + $c_row;
		$new_no = 'CN'.$total_no;
		$debtor = 'YES';
		
		$qry_save = "INSERT INTO f_cn(debtor,internal_exam_fee,cn_no, cn_date, s_name, 
									  s_ic, pay_mtd, tuition_fee, ptpk, cn_status, 
									  createdate, createby, hostel_fee, receipt_type , org_bill_no)
							   VALUES('".$debtor."', 'NO', '".$new_no."','".$_POST['date']."', '".mysqli_real_escape_string($conn,$_POST['name'])."', 
							   		  '".$_POST['ic']."', '".$pay_mtd."', 'NO','".$loan."', 'ACTIVE', 
							   		  '".DATE_TODAY."', '".$_SESSION['id']."', 'NO', '1', '".$_POST['org_bill_no']."')";
		if($result_save = mysqli_query($conn, $qry_save)){
			 
			$cn_id = mysqli_insert_id($conn);

			if(isset($_POST['bankin']) && $_POST['bankin'] == 'bankin'){
				echo 123;
				// $qry_bankin = "INSERT INTO f_b_c(cn_id, cheque_no, banker, in_date)VALUES('".$cn_id."', 'BANKIN', '".$_POST['bankin_banker']."', '".$_POST['bankin_date']."')";
				// if($result_bankin = mysqli_query($conn, $qry_bankin)){
				// 	$qry = "SELECT * FROM f_cn_cart WHERE u_id='".$_SESSION['id']."'";
				// 	$result = mysqli_query($conn, $qry);
				// 	while($row = mysqli_fetch_array($result)){
				// 		$qry_rd = "INSERT INTO f_cn_detail(cn_id, rp_desc, rp_amount)VALUES('".$cn_id."', '".$row['c_desc']."', '".$row['c_amount']."')";
				// 		if($result_rd = mysqli_query($conn, $qry_rd)){
				// 			$qry_del = "DELETE FROM f_cn_cart WHERE id='".$row['id']."'";
				// 			if($result_del = mysqli_query($conn, $qry_del)){				// 				
				// 				echo "<script>
				// 						window.location.href = 'f_choose1.php?action=msg_choose&id=$cn_id';
				// 				</script>";
				// 			}else{
				// 				echo "<script>
				// 				window.location.href = 'f_cn_form1.php?action=msg_bankin_cart_fail_del';
				// 				</script>";
				// 			}
				// 		}else{
				// 			echo "<script>
				// 			window.location.href = 'f_cn_form1.php?action=msg_bankin_receipt_detail_fail_save';
				// 			</script>";
				// 		}
				// 	}
				// }else{
				// 	echo "<script>
				// 	window.location.href = 'f_cn_form1.php?action=msg_bankin_fail_save';
				// 	</script>";
				// }
			 }elseif(isset($_POST['cheque']) && $_POST['cheque'] == 'cheque'){
			 	echo 456;
			// 	$qry_cheque = "INSERT INTO f_b_c(cn_id, cheque_no, banker, in_date)VALUES('".$cn_id."', '".$_POST['c_no']."', '".$_POST['banker']."', '".$_POST['dated']."')";
			// 	if($result_cheque = mysqli_query($conn, $qry_cheque)){
			// 		$qry = "SELECT * FROM f_cn_cart WHERE u_id='".$_SESSION['id']."'";
			// 		$result = mysqli_query($conn, $qry);
			// 		while($row = mysqli_fetch_array($result)){
			// 			$qry_rd = "INSERT INTO f_cn_detail(cn_id, rp_desc, rp_amount)VALUES('".$cn_id."', '".$row['c_desc']."', '".$row['c_amount']."')";
			// 			if($result_rd = mysqli_query($conn, $qry_rd)){
			// 				$qry_del = "DELETE FROM f_cn_cart WHERE id='".$row['id']."'";
			// 				if($result_del = mysqli_query($conn, $qry_del)){								
			// 					echo "<script>
			// 							window.location.href = 'f_choose1.php?action=msg_choose&id=$cn_id';
			// 					</script>";
			// 				}else{
			// 					echo "<script>
			// 					window.location.href = 'f_cn_form1.php?action=msg_cheque_cart_fail_del';
			// 					</script>";
			// 				}
			// 			}else{
			// 				echo "<script>
			// 				window.location.href = 'f_cn_form1.php?action=msg_cheque_receipt_detail_fail_save';
			// 				</script>";
			// 			}
			// 		}
			// 	}else{
			// 		echo "<script>
			// 		window.location.href = 'f_cn_form1.php?action=msg_cheque_fail_save';
			// 		</script>";
			// 	}
			 }else{			 	 
				$qry = "SELECT * FROM f_cn_cart WHERE u_id='".$_SESSION['id']."'";
				$result = mysqli_query($conn, $qry);			
				while($row = mysqli_fetch_array($result)){
				 
					$qry_rd = "INSERT INTO f_cn_detail(cn_id, cn_desc, cn_amount)
									  	 		VALUES('".$cn_id."', '".$row['c_desc']."', '".$row['c_amount']."')";
									  	 		
					if($result_rd = mysqli_query($conn, $qry_rd)){
						$qry_del = "DELETE FROM f_cn_cart WHERE id='".$row['id']."'";
						if($result_del = mysqli_query($conn, $qry_del)){
							echo 123;
							echo "<script>
									window.location.href = 'f_cn_choose1.php?action=msg_choose&id=$cn_id';
							</script>";
						}else{
							echo 456;
							echo "<script>
							window.location.href = 'f_cn_form1.php?action=msg_cart_fail_del';
							</script>";
						}
					}else{
						echo "<script>
						window.location.href = 'f_cn_form1.php?action=msg_receipt_detail_fail_save';
						</script>";
					}
				}
			}
		}else{
			echo "<script>
			window.location.href = 'f_cn_form1.php?action=msg_receipt_fail_save';
			</script>";
		}
	}else{
		echo "<script>
		window.location.href = 'f_cn_form1.php?action=msg_cart_empty';
		</script>";
	}
}

if(isset($_POST['submit']) && $_POST['submit'] == 'edit'){

	$bankin_date = '';
	$date = '';
	
	if(isset($_POST['bankin']) && $_POST['bankin'] == 'bankin'){
		$pay_mtd = $_POST['bankin'];
	}elseif(isset($_POST['cheque']) && $_POST['cheque'] == 'cheque'){
		$pay_mtd = $_POST['cheque'];
	}else{
		$pay_mtd = 'cash';
	}
	
	if(isset($_POST['c_loan']) && $_POST['c_loan'] == 'loan'){
		$loan = 'YES';
	}else{
		$loan = 'NO';
	}
	
	if(isset($_POST['date']) && !empty($_POST['date'])){
		$date .= ", cn_date='".$_POST['date']."'";
	}else{
		$date = '';
	}
	
	$qry_save = "UPDATE f_cn SET debtor='YES', 
								 internal_exam_fee='NO', 
								 s_name='".mysqli_real_escape_string($conn,$_POST['name'])."', 
								 s_ic='".$_POST['ic']."', pay_mtd='".$pay_mtd."', 
								 tuition_fee='NO', 
								 ptpk='".$loan."', 
								 hostel_fee='NO'".$date." ,
								 org_bill_no = '".$_POST['org_bill_no']."' 
								 WHERE id = '".$_GET['id']."' ";
	
	if($result_save = mysqli_query($conn, $qry_save)){
		if(isset($_POST['bankin']) && $_POST['bankin'] == 'bankin'){
			
			if(isset($_POST['bankin_date']) && !empty($_POST['bankin_date'])){
				$bankin_date .= ", in_date='".$_POST['bankin_date']."'";
			}else{
				$bankin_date = '';
			}
			
			$c_qry = "SELECT * FROM f_b_c WHERE cn_id = '".$_GET['id']."'";
			$c_result = mysqli_query($conn,$c_qry);
			$c_rows = mysqli_num_rows($c_result);
			
			if($c_rows > 0){
				$qry_bankin = "UPDATE f_b_c SET cheque_no='BANKIN', banker='".$_POST['bankin_banker']."'".$bankin_date." WHERE cn_id = '".$_GET['id']."'";
				if($result_bankin = mysqli_query($conn, $qry_bankin)){
					echo "<script>
					window.location.href = 'f_cn_edit1.php?action=msg_bankin_success_edit&id=$_GET[id]';
					</script>";
				}else{
					echo "<script>
					window.location.href = 'f_cn_edit1.php?action=msg_receipt_fail_edit1&id=$_GET[id]';
					</script>";
				}
			}else{
				$qry_bankin = "INSERT INTO f_b_c (cn_id,cheque_no,banker,in_date)VALUES('".$_GET['id']."','BANKIN','".$_POST['bankin_banker']."','".$_POST['bankin_date']."')";
				if($result_bankin = mysqli_query($conn, $qry_bankin)){
					echo "<script>
					window.location.href = 'f_cn_edit1.php?action=msg_bankin_success_edit&id=$_GET[id]';
					</script>";
				}else{
					echo "<script>
					window.location.href = 'f_cn_edit1.php?action=msg_receipt_fail_edit1&id=$_GET[id]';
					</script>";
				}
			}
		}elseif(isset($_POST['cheque']) && $_POST['cheque'] == 'cheque'){
			
			if(isset($_POST['dated']) && !empty($_POST['dated'])){
				$bankin_date .= ", in_date='".$_POST['dated']."'";
			}else{
				$bankin_date = '';
			}
			
			$c_qry = "SELECT * FROM f_b_c WHERE cn_id = '".$_GET['id']."'";
			$c_result = mysqli_query($conn,$c_qry);
			$c_rows = mysqli_num_rows($c_result);
			
			if($c_rows > 0){
			
				$qry_cheque = "UPDATE f_b_c SET cheque_no = '".$_POST['c_no']."', banker='".$_POST['banker']."'".$bankin_date." WHERE cn_id = '".$_GET['id']."'";
				if($result_cheque = mysqli_query($conn, $qry_cheque)){
					echo "<script>
					window.location.href = 'f_cn_edit1.php?action=msg_bankin_success_edit&id=$_GET[id]';
					</script>";
				}else{
					echo "<script>
					window.location.href = 'f_cn_edit1.php?action=msg_receipt_fail_edit1&id=$_GET[id]';
					</script>";
				}
			}else{
				$qry_bankin = "INSERT INTO f_b_c (cn_id,cheque_no,banker,in_date)VALUES('".$_GET['id']."','".$_POST['c_no']."','".$_POST['banker']."','".$_POST['dated']."')";
				if($result_bankin = mysqli_query($conn, $qry_bankin)){
					echo "<script>
					window.location.href = 'f_cn_edit1.php?action=msg_bankin_success_edit&id=$_GET[id]';
					</script>";
				}else{
					echo "<script>
					window.location.href = 'f_cn_edit1.php?action=msg_receipt_fail_edit1&id=$_GET[id]';
					</script>";
				}
			}
		}else{
			echo "<script>
			window.location.href = 'f_cn_edit1.php?action=msg_bankin_success_edit&id=$_GET[id]';
			</script>";
		}
	}else{
		echo "<script>
		window.location.href = 'f_cn_edit1.php?action=msg_receipt_fail_edit&id=$_GET[id]';
		</script>";
	}
}
?>