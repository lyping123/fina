<?php
require('include/db.php');
// if (!isset($_SESSION['id'])){
// 	echo "<script type='text/javascript'>
// 		  alert('Your session is expired, please login again');
// 		  window.location.href = 'index.php?action=login_error&status=receipt'
// 		  </script>";
		  
// }


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
	$qry_add = "DELETE FROM f_receipt_detail WHERE id='".$_GET['id']."'";
	if($result_add = mysqli_query($conn, $qry_add)){
		echo "<script>
		window.location.href = 'f_receipt_edit1.php?action=msg_receipt_success_del&id=$_GET[r_id]';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'f_receipt_edit1.php?action=msg_receipt_fail_del&id=$_GET[r_id]';
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
	
		if(isset($_POST['boc']) && $_POST['boc'] == 'b'){
			$pay_mtd = 'bankin';
		}elseif(isset($_POST['boc']) && $_POST['boc'] == 'c'){
			$pay_mtd = 'cheque';
		}elseif(isset($_POST['boc']) && $_POST['boc'] == 'cd'){
			$pay_mtd = 'credit card';
		}elseif(isset($_POST['boc']) && $_POST['boc'] == 'db'){
			$pay_mtd = 'debit card';
		}else{
			$pay_mtd = 'cash';
		}
		$status="NO";
		// if($_POST['p_type']=="Hostel Fee"){
		// 	 $query_select="select h_status from student where id='".$_POST['name']."'";
			 
		// 	$sttr_select=mysqli_query($conn,$query_select);
		// 	$result_select=mysqli_fetch_array($sttr_select);
		// 	 /*$sum_query="select sum(c_amount)as amount from f_cart where u_id='".$_SESSION['id']."'";
		// 	$sttr_sum=mysqli_query($conn,$sum_query);
		// 	$result_add=mysqli_fetch_array($sttr_sum);*/
			
		// 	if($result_select['h_status']=='NO'){
				
		// 		echo "<script>window.location.href='f_receipt_form1.php?action=meg_hostel_exis'</script>";
		// 		break;
		// 	}
		// 	else{
        //         if($_POST['h_type'] == 1){
		// 		    $status="YES";
        //         }else{
		// 		    $status="NO";
        //         }
		// 	}
			
			   
		// }
		
        $price=$_POST['price'];
        $descriction="";
		$level=$_POST["level"];

		
		 $qry_save = "INSERT INTO f_receipt(r_date, pay_mtd, r_status, createdate, createby, receipt_type, cash_bill_option, s_id,remark)VALUES('".$_POST['date']."', '".$pay_mtd."', 'ACTIVE', '".DATE_TODAY."', '".$_SESSION['id']."', '".$_POST['c_type']."', '".$_POST['p_type']."', '".$_POST['name']."', '".$_POST['remark']."')";
		if($result_save = mysqli_query($conn, $qry_save)){
			$r_id = mysqli_insert_id($conn);
			
			if(isset($_POST["tl_payment"])){
				$update="update student set p_method='".$_POST["tl_payment"]."' where id='".$_POST['name']."'";
				$sttr=mysqli_query($conn,$update);
			}
			  
			   if($status=="YES"){
                   if(isset($_POST['l_payment'])){
                       $lpd = 'LAST PAYMENT';
                   }else{
                       $lpd = $_POST['npd'];
                   }
                   
                    foreach($_POST['desc'] as $index =>$code){
                        //$descriction.=$code." (".$level[$index].") ";
                        if($descriction == 'HOSTEL FEE'){
                            $pay += $price[$index];
                        }
                    }
                   
				   	$qry_hostel="insert into duration(studentid,receipt_id,paymentDate,pay_until,next_payment,status,amount)values('".$_POST['name']."','".$r_id."','".$_POST['pd']."','".$_POST['pum']."','".$lpd."','ACTIVE','".$pay."')";
			   		$sttr_hostel=mysqli_query($conn,$qry_hostel);
			   }
        if($_POST['p_type']=="Tuition PTPK"){
            $amount=0;
            foreach($price as $pri_each){
                $amount+=$pri_each;
            }
            $up="update student set tuition_fee_left=tuition_fee_left-".$amount.",rep_date ='".$_POST['date']."' where id='".$_POST['name']."'";
            $sttr_up=mysqli_query($conn,$up);
            /*$query_tui="insert into tuitionfee_detail(s_id,r_id, onth,rep_date)values('".$_POST['name']."','".$r_id."','".$_POST['stage']."','".$_POST['date']."')";
			$sttr_tui=mysqli_query($conn,$query_tui);*/
		}
			   
			if(isset($_POST['boc']) && $_POST['boc'] == 'b'){
				$qry_bankin = "INSERT INTO f_b_c(r_id, cheque_no, banker, in_date, payment_reference)VALUES('".$r_id."', 'BANKIN', '".$_POST['bankin_banker']."', '".$_POST['bankin_date']."', '".$_POST['pr']."')";
				
				if($result_bankin = mysqli_query($conn, $qry_bankin)){
					/*$qry = "SELECT * FROM f_cart WHERE u_id='".$_SESSION['id']."'";
					$result = mysqli_query($conn, $qry);*/
                    
                    foreach($_POST['desc'] as $index =>$code){
						if(empty($level[$index])){
							$descriction=$code;
						}else{
							$descriction=$code." (".$level[$index].") ";
						}

                        $qry_rd = "INSERT INTO f_receipt_detail(r_id, rp_desc, rp_amount)VALUES('".$r_id."', '".$descriction."', '".$price[$index]."')";
                        if($result_rd = mysqli_query($conn, $qry_rd)){
                            echo "<script>
                                    window.location.href = 'f_choose1.php?action=msg_choose&id=$r_id';
                            </script>";
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
			}elseif((isset($_POST['boc']) && $_POST['boc'] == 'c') || (isset($_POST["boc"]) && $_POST["boc"]=="cd") || (isset($_POST["boc"]) && $_POST["boc"]=="db")){
				$qry_cheque = "INSERT INTO f_b_c(r_id, cheque_no, banker, in_date)VALUES('".$r_id."', '".$_POST['c_no']."', '".$_POST['banker']."', '".$_POST['dated']."')";
				
				if($result_cheque = mysqli_query($conn, $qry_cheque)){
					/*$qry = "SELECT * FROM f_cart WHERE u_id='".$_SESSION['id']."'";
					$result = mysqli_query($conn, $qry);*/
                    foreach($_POST['desc'] as $index =>$code){
						if(empty($level[$index])){
							$descriction=$code;
						}else{
							$descriction=$code." (".$level[$index].") ";
						}
						
                        $qry_rd = "INSERT INTO f_receipt_detail(r_id, rp_desc, rp_amount)VALUES('".$r_id."', '".$descriction."', '".$price[$index]."')";
                        if($result_rd = mysqli_query($conn, $qry_rd)){
                            echo "<script>
                                    window.location.href = 'f_choose1.php?action=msg_choose&id=$r_id';
                            </script>";
                        }else{
                            echo "<script>
                            window.location.href = 'f_receipt_form1.php?action=msg_bankin_receipt_detail_fail_save';
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
				if(empty($level[$index])){
					$descriction=$code;
				}else{
					$descriction=$code." (".$level[$index].") ";
				}
				//$descriction=$code." (".$level[$index].") ";
					$qry_rd = "INSERT INTO f_receipt_detail(r_id, rp_desc, rp_amount)VALUES('".$r_id."', '".$descriction."', '".$price[$index]."')";
					if($result_rd = mysqli_query($conn, $qry_rd)){
                        echo "<script>
                                window.location.href = 'f_choose1.php?action=msg_choose&id=$r_id';
                        </script>";
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

if(isset($_POST['edit']) && $_POST['edit'] == 'edit'){
	
	$date = '';
	$id=$_GET['id'];
	if(isset($_POST['date']) && !empty($_POST['date'])){
		$date .= ", r_date='".$_POST['date']."'";
	}else{
		$date = '';
	}

	if(isset($_POST['boc']) && $_POST['boc'] == 'b'){
		$pay_mtd = 'bankin';
	}elseif(isset($_POST['boc']) && $_POST['boc'] == 'c'){
		$pay_mtd = 'cheque';
	}elseif(isset($_POST['boc']) && $_POST['boc'] == 'cd'){
		$pay_mtd = 'credit card';
	}elseif(isset($_POST['boc']) && $_POST['boc'] == 'db'){
		$pay_mtd = 'debit card';
	}else{
		$pay_mtd = 'cash';
	}
	
	$qry_save = "UPDATE f_receipt SET new_remark='".$_POST['new_remark']."' ,s_id='".$_POST['name']."', pay_mtd='".$pay_mtd."', receipt_type='".$_POST['c_type']."', cash_bill_option='".$_POST['p_type']."', remark='".$_POST['remark']."'".$date." WHERE id = '".$_GET['id']."' ";
	
	if($result_save = mysqli_query($conn, $qry_save)){
            if($_POST['p_type']=="Hostel Fee" && $_POST['h_type']=="1"){
                $qry_h="update duration set paymentDate='".$_POST['pd']."',pay_until='".$_POST['pum']."',next_payment='".$_POST['npd']."' where receipt_id='".$_GET['id']."'";
                $sttr_h=mysqli_query($conn,$qry_h);
                echo "<script>
                    window.location.href='f_receipt_edit1.php?id=".$_GET['id']."'
                </script>";
                //break;
            }
            
            
           
        $price=$_POST['price'];
        $descriction="";
		$level=$_POST["level"];
                foreach($_POST['desc'] as $index =>$code){
						echo $$level[$index];
						
						if(empty($level[$index])){
							$descriction=$code;
						}else{
							$descriction=$code." (".$level[$index].") ";
						}
								
                        
                        if($code!==""){
                            $qry_rd = "INSERT INTO f_receipt_detail(r_id, rp_desc, rp_amount)VALUES('".$_GET['id']."', '".$descriction."', '".$price[$index]."')";
                            $result_rd = mysqli_query($conn, $qry_rd);  
                        }
                                                
                           
                    }
            
             
        
       
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
				$qry_bankin = "UPDATE f_b_c SET cheque_no='BANKIN', banker='".$_POST['bankin_banker']."', payment_reference='".$_POST['pr']."'".$bankin_date." WHERE r_id = '".$_GET['id']."'";
				if($result_bankin = mysqli_query($conn, $qry_bankin)){
					echo "<script>
					window.location.href = 'f_receipt_edit1.php?action=msg_bankin_success_edit&id=".$id."';
					</script>";
				}else{
					echo "<script>
					window.location.href = 'f_receipt_edit1.php?action=msg_receipt_fail_edit1&id=".$id."';
					</script>";
				}
			}else{
				$qry_bankin = "INSERT INTO f_b_c (r_id,cheque_no,banker,in_date,payment_reference)VALUES('".$_GET['id']."','BANKIN','".$_POST['bankin_banker']."','".$_POST['bankin_date']."','".$_POST['pr']."')";
				if($result_bankin = mysqli_query($conn, $qry_bankin)){
					echo "<script>
					window.location.href = 'f_receipt_edit1.php?action=msg_bankin_success_edit&id=".$id."';
					</script>";
				}else{
					echo "<script>
					window.location.href = 'f_receipt_edit1.php?action=msg_receipt_fail_edit1&id=".$id."';
					</script>";
				}
			}
		}elseif((isset($_POST['boc']) && $_POST['boc']=="c") || (isset($_POST["boc"]) && $_POST["boc"]=="cd") || (isset($_POST["boc"]) && $_POST["boc"]=="db")){
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
			
				echo $qry_cheque = "UPDATE f_b_c SET cheque_no = '".$_POST['c_no']."', banker='".$_POST['banker']."', payment_reference='".$_POST['pr']."'".$bankin_date." WHERE r_id = '".$id."'";
				if($result_cheque = mysqli_query($conn, $qry_cheque)){
					echo "<script>
					window.location.href = 'f_receipt_edit1.php?action=msg_bankin_success_edit&id=".$id."';
					</script>";
				}else{
					echo "<script>
					window.location.href = 'f_receipt_edit1.php?action=msg_receipt_fail_edit1&id=".$id."';
					</script>";
				}
			}else{
				echo $qry_bankin = "INSERT INTO f_b_c (r_id,cheque_no,banker,in_date,payment_reference)VALUES('".$_GET['id']."','".$_POST['c_no']."','".$_POST['banker']."','".$_POST['dated']."','".$_POST['pr']."')";
				if($result_bankin = mysqli_query($conn, $qry_bankin)){
					echo "<script>
					window.location.href = 'f_receipt_edit1.php?action=msg_bankin_success_edit&id=".$id."';
					</script>";
				}else{
					echo "<script>
					window.location.href = 'f_receipt_edit1.php?action=msg_receipt_fail_edit1&id=".$id."';
					</script>";
				}
			}
		}else{
			echo "<script>
			window.location.href = 'f_receipt_edit1.php?action=msg_bankin_success_edit&id=".$id."';
			</script>";
		}
	}else{
		echo "<script>
		window.location.href = 'f_receipt_edit1.php?action=msg_receipt_fail_edit&id=".$id."';
		</script>";
	}
}
?>