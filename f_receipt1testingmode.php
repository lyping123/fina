<?php
require('include/db.php');

if(isset($_POST['submit']) && $_POST['submit'] == 'add'){
	$qry_add = "INSERT INTO f_cart(c_desc, c_amount, u_id)VALUES('".$_POST['desc']."', '".$_POST['amount']."', '".$_SESSION['id']."')";
	if($result_add = mysqli_query($conn, $qry_add)){
		echo "<script>	
		window.location.href = 'f_receipt_form1.php?action=msg_receipt_success_add';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'f_receipt_form1.php?action=msg_receipt_fail_add';
		</script>";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'delete_receipt'){
	//$qry_add = "UPDATE f_receipt SET r_status='DELETE' WHERE id='".$_GET['id']."'";
	$qry_add = "DELETE FROM f_receipt WHERE id='".$_GET['id']."'";
	if($result_add = mysqli_query($conn, $qry_add)){
		echo "<script>
		window.location.href = 'f_receipt_list1.php?action=msg_receipt_success_del';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'f_receipt_list1.php?action=msg_receipt_fail_del';
		</script>";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
	$qry_add = "DELETE FROM f_cart WHERE id='".$_GET['id']."'";
	if($result_add = mysqli_query($conn, $qry_add)){
		echo "<script>
		window.location.href = 'f_receipt_form1.php?action=msg_receipt_success_del';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'f_receipt_form1.php?action=msg_receipt_fail_del';
		</script>";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'clear'){
	$qry_add = "DELETE FROM f_cart WHERE u_id = '".$_SESSION['id']."'";
	if($result_add = mysqli_query($conn, $qry_add)){
		echo "<script>
		window.location.href = 'f_receipt_form1.php?action=msg_receipt_success_clear';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'f_receipt_form1.php?action=msg_receipt_fail_clear';
		</script>";
	}
}

if(isset($_POST['submit']) && $_POST['submit'] == 'save'){
	
	
	/*if($c_rows > 0){*/
		
		if(isset($_POST['boc']) && $_POST['boc'] == 'b'){
			$pay_mtd = 'bankin';
		}elseif(isset($_POST['boc']) && $_POST['boc'] == 'c'){
			$pay_mtd = 'cheque';
		}else{
			$pay_mtd = 'cash';
		}
		$status="NO";
		if($_POST['p_type']=="Hostel Fee"){
			 $query_select="select h_status from student where id='".$_POST['name']."'";
			 
			$sttr_select=mysqli_query($conn,$query_select);
			$result_select=mysqli_fetch_array($sttr_select);
			 $sum_query="select sum(c_amount)as amount from f_cart where u_id='".$_SESSION['id']."'";
			$sttr_sum=mysqli_query($conn,$sum_query);
			$result_add=mysqli_fetch_array($sttr_sum);
			
			if($result_select['h_status']=='NO'){
				
				echo "<script>window.location.href='f_receipt_form1.php?action=meg_hostel_exis'</script>";
				break;
			}
			else{
				$status="YES";
			}
			
			   
		}
		
		$course=$_POST['course'];
            $level=$_POST['level'];
        $price=$_POST['price'];
        $descriction="";
		
		
		 $qry_save = "INSERT INTO f_receipt(r_date, pay_mtd, r_status, createdate, createby, receipt_type, cash_bill_option, s_id,remark)VALUES('".$_POST['date']."', '".$pay_mtd."', 'ACTIVE', '".DATE_TODAY."', '".$_SESSION['id']."', '".$_POST['c_type']."', '".$_POST['p_type']."', '".$_POST['name']."', '".$_POST['remark']."')";
		if($result_save = mysqli_query($conn, $qry_save)){
			$r_id = mysqli_insert_id($conn);
			
			  
			   if($status=="YES"){
				   $qry_hostel="insert into duration(studentid,receipt_id,paymentDate,pay_until,next_payment,status,amount)values('".$_POST['name']."','".$r_id."','".$_POST['pd']."','".$_POST['pum']."','".$_POST['npd']."','ACTIVE','".$result_add['amount']."')";
			   		$sttr_hostel=mysqli_query($conn,$qry_hostel);
			   }
			   if($_POST['p_type']=="Tuition Fee" ||  $_POST['p_type']=="Debtor PTPK" || $_POST['p_type']=="Debtor"){
                   $amount=0;
                   
			 foreach($price as $pri_each){
			     $amount+=$pri_each;
			 }
 $up="update student set total_pay=total_pay+".$amount.",tuition_fee_left=tuition_fee_left-".$amount.",rep_date ='".$_POST['date']."' where id='".$_POST['name']."'";
			$sttr_up=mysqli_query($conn,$up);
			 
		}elseif($_POST['p_type']=="Internal Exam Fee"){
			$amount=0;
			 foreach($price as $pri_each){
			     $amount+=$pri_each;
			 }
			 echo $int_update="update student set int_outstanding=int_outstanding-".$amount." where id='".$_POST['name']."'";
			$sttr_int=mysqli_query($conn,$int_update);
                  
			
		}elseif($_POST['p_type']=="Tuition PTPK"){
		    $amount=0;
			 foreach($price as $pri_each){
			     $amount+=$pri_each;
			 }
                   $up="update student set tuition_fee_left=tuition_fee_left-".$amount.",rep_date ='".$_POST['date']."' where id='".$_POST['name']."'";
			$sttr_up=mysqli_query($conn,$up);
			
		}
			   
			if(isset($_POST['boc']) && $_POST['boc'] == 'b'){
				$qry_bankin = "INSERT INTO f_b_c(r_id, cheque_no, banker, in_date)VALUES('".$r_id."', 'BANKIN', '".$_POST['bankin_banker']."', '".$_POST['bankin_date']."')";
				
				if($result_bankin = mysqli_query($conn, $qry_bankin)){
					$qry = "SELECT * FROM f_cart WHERE u_id='".$_SESSION['id']."'";
					$result = mysqli_query($conn, $qry);
                    
		            
		foreach($_POST['desc'] as $index =>$code){
                        $descriction=$code." - ".$course[$index]."(".$level[$index].")";
                        
						echo $qry_rd = "INSERT INTO f_receipt_detail(r_id, rp_desc, rp_amount)VALUES('".$r_id."', '".$descriction."', '".$price[$index]."')";
						if($result_rd = mysqli_query($conn, $qry_rd)){
							$qry_del = "DELETE FROM f_cart WHERE id='".$row['id']."'";
							if($result_del = mysqli_query($conn, $qry_del)){
								/*echo "<script>
									setTimeout(function(){
										window.location.href = 'f_receipt_form.php?action=msg_save';
										window.open('print_receipt.php?&id=$r_id');
									}, 2500); 
								</script>";*/
								echo "<script>
										window.location.href = 'f_choose1.php?action=msg_choose&id=$r_id';
								</script>";
							}else{
								echo "<script>
								window.location.href = 'f_receipt_form1.php?action=msg_bankin_cart_fail_del';
								</script>";
							}
						}else{
							echo "<script>
							window.location.href = 'f_receipt_form1.php?action=msg_bankin_receipt_detail_fail_save';
							</script>";
						}
					
		}
					
				}else{
					echo "<script>
					window.location.href = 'f_receipt_form1.php?action=msg_bankin_fail_save';
					</script>";
				}
			}elseif(isset($_POST['boc']) && $_POST['boc'] == 'c'){
				$qry_cheque = "INSERT INTO f_b_c(r_id, cheque_no, banker, in_date)VALUES('".$r_id."', '".$_POST['c_no']."', '".$_POST['banker']."', '".$_POST['dated']."')";
				
				if($result_cheque = mysqli_query($conn, $qry_cheque)){
					$qry = "SELECT * FROM f_cart WHERE u_id='".$_SESSION['id']."'";
					$result = mysqli_query($conn, $qry);
                    foreach($_POST['desc'] as $index =>$code){
			            $descriction=$code." - ".$course[$index]."(".$level[$index].")";
                        $price[$index]."<br>";
            
						echo $qry_rd = "INSERT INTO f_receipt_detail(r_id, rp_desc, rp_amount)VALUES('".$r_id."', '".$descriction."', '".$price[$index]."')";
                        break;
						if($result_rd = mysqli_query($conn, $qry_rd)){
							$qry_del = "DELETE FROM f_cart WHERE id='".$row['id']."'";
							if($result_del = mysqli_query($conn, $qry_del)){
								/*echo "<script>
									setTimeout(function(){
										window.location.href = 'f_receipt_form.php?action=msg_save';
										window.open('print_receipt.php?&id=$r_id');
									}, 2500);*/
								echo "<script>
										window.location.href = 'f_choose1.php?action=msg_choose&id=$r_id';
								</script>";
							}else{
								echo "<script>
								window.location.href = 'f_receipt_form1.php?action=msg_cheque_cart_fail_del';
								</script>";
							}
						}else{
							echo "<script>
							window.location.href = 'f_receipt_form1.php?action=msg_cheque_receipt_detail_fail_save';
							</script>";
						}
					
		}
					
				}else{
					echo "<script>
					window.location.href = 'f_receipt_form1.php?action=msg_cheque_fail_save';
					</script>";
				}
			}else{
                
                foreach($_POST['desc'] as $index =>$code){
                $descriction=$code." - ".$course[$index]."(".$level[$index].")";
           
                    
						echo $qry_rd = "INSERT INTO f_receipt_detail(r_id, rp_desc, rp_amount)VALUES('".$r_id."', '".$descriction."', '".$price[$index]."')";
					if($result_rd = mysqli_query($conn, $qry_rd)){
						$qry_del = "DELETE FROM f_cart WHERE id='".$row['id']."'";
						if($result_del = mysqli_query($conn, $qry_del)){
							echo "<script>
									window.location.href = 'f_choose1.php?action=msg_choose&id=$r_id';
							</script>";
						}else{
							echo "<script>
							window.location.href = 'f_receipt_form1.php?action=msg_cart_fail_del';
							</script>";
						}
					}else{
						echo "<script>
						window.location.href = 'f_receipt_form1.php?action=msg_receipt_detail_fail_save';
						</script>";
					}
					
		}
				
			}
		}else{
			echo "<script>
			window.location.href = 'f_receipt_form1.php?action=msg_receipt_fail_save';
			</script>";
		}
	/*}else{
		echo "<script>
		window.location.href = 'f_receipt_form1.php?action=msg_cart_empty';
		</script>";
	}*/
}

if(isset($_POST['submit']) && $_POST['submit'] == 'edit'){
	
	$date = '';
	
	if(isset($_POST['date']) && !empty($_POST['date'])){
		$date .= ", r_date='".$_POST['date']."'";
	}else{
		$date = '';
	}

	if(isset($_POST['boc']) && $_POST['boc'] == 'b'){
		$pay_mtd = 'bankin';
	}elseif(isset($_POST['boc']) && $_POST['boc'] == 'c'){
		$pay_mtd = 'cheque';
	}else{
		$pay_mtd = 'cash';
	}
	
	$qry_save = "UPDATE f_receipt SET s_id='".$_POST['name']."', pay_mtd='".$pay_mtd."', receipt_type='".$_POST['c_type']."', cash_bill_option='".$_POST['p_type']."', remark='".$_POST['remark']."'".$date." WHERE id = '".$_GET['id']."' ";
	
	if($result_save = mysqli_query($conn, $qry_save)){
		if(isset($_POST['boc']) && $_POST['boc'] == 'b'){
			$bankin_date = '';
			if(isset($_POST['bankin_date']) && !empty($_POST['bankin_date'])){
				$bankin_date .= ", in_date='".$_POST['bankin_date']."'";
			}else{
				$bankin_date = '';
			}
			
			$c_qry = "SELECT * FROM f_b_c WHERE r_id = '".$_GET['id']."'";
			$c_result = mysqli_query($conn,$c_qry);
			$c_rows = mysqli_num_rows($c_result);
			
			if($c_rows > 0){
				$qry_bankin = "UPDATE f_b_c SET cheque_no='BANKIN', banker='".$_POST['bankin_banker']."'".$bankin_date." WHERE r_id = '".$_GET['id']."'";
				if($result_bankin = mysqli_query($conn, $qry_bankin)){
					echo "<script>
					window.location.href = 'f_receipt_edit1.php?action=msg_bankin_success_edit&id=$_GET[id]';
					</script>";
				}else{
					echo "<script>
					window.location.href = 'f_receipt_edit1.php?action=msg_receipt_fail_edit1&id=$_GET[id]';
					</script>";
				}
			}else{
				$qry_bankin = "INSERT INTO f_b_c (r_id,cheque_no,banker,in_date)VALUES('".$_GET['id']."','BANKIN','".$_POST['bankin_banker']."','".$_POST['bankin_date']."')";
				if($result_bankin = mysqli_query($conn, $qry_bankin)){
					echo "<script>
					window.location.href = 'f_receipt_edit1.php?action=msg_bankin_success_edit&id=$_GET[id]';
					</script>";
				}else{
					echo "<script>
					window.location.href = 'f_receipt_edit1.php?action=msg_receipt_fail_edit1&id=$_GET[id]';
					</script>";
				}
			}
		}elseif(isset($_POST['boc']) && $_POST['boc'] == 'c'){
			$bankin_date = '';
			if(isset($_POST['dated']) && !empty($_POST['dated'])){
				$bankin_date .= ", in_date='".$_POST['dated']."'";
			}else{
				$bankin_date = '';
			}
			
			$c_qry = "SELECT * FROM f_b_c WHERE r_id = '".$_GET['id']."'";
			$c_result = mysqli_query($conn,$c_qry);
			$c_rows = mysqli_num_rows($c_result);
			
			if($c_rows > 0){
			
				$qry_cheque = "UPDATE f_b_c SET cheque_no = '".$_POST['c_no']."', banker='".$_POST['banker']."'".$bankin_date." WHERE r_id = '".$_GET['id']."'";
				if($result_cheque = mysqli_query($conn, $qry_cheque)){
					echo "<script>
					window.location.href = 'f_receipt_edit1.php?action=msg_bankin_success_edit&id=$_GET[id]';
					</script>";
				}else{
					echo "<script>
					window.location.href = 'f_receipt_edit1.php?action=msg_receipt_fail_edit1&id=$_GET[id]';
					</script>";
				}
			}else{
				$qry_bankin = "INSERT INTO f_b_c (r_id,cheque_no,banker,in_date)VALUES('".$_GET['id']."','".$_POST['c_no']."','".$_POST['banker']."','".$_POST['dated']."')";
				if($result_bankin = mysqli_query($conn, $qry_bankin)){
					echo "<script>
					window.location.href = 'f_receipt_edit1.php?action=msg_bankin_success_edit&id=$_GET[id]';
					</script>";
				}else{
					echo "<script>
					window.location.href = 'f_receipt_edit1.php?action=msg_receipt_fail_edit1&id=$_GET[id]';
					</script>";
				}
			}
		}else{
			echo "<script>
			window.location.href = 'f_receipt_edit1.php?action=msg_bankin_success_edit&id=$_GET[id]';
			</script>";
		}
	}else{
		echo "<script>
		window.location.href = 'f_receipt_edit1.php?action=msg_receipt_fail_edit&id=$_GET[id]';
		</script>";
	}
}
?>