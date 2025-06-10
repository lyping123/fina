<?php
require('include/db.php');

if(isset($_POST['submit']) && $_POST['submit'] == 'add'){
	$qry_add = "INSERT INTO f_cart(c_desc, c_amount, u_id)VALUES('".$_POST['desc']."', '".$_POST['amount']."', '".$_SESSION['id']."')";
	if($result_add = mysqli_query($conn, $qry_add)){
        
		echo "<script>	
		window.location.href = '.php?action=msg_receipt_success_add';
		</script>";
	}else{
        
		echo "<script>
		window.location.href = 'student_upload_receipt.php?action=msg_receipt_fail_add';
		</script>";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'delete_receipt'){
	//$qry_add = "UPDATE f_receipt SET r_status='DELETE' WHERE id='".$_GET['id']."'";
	$qry_add = "DELETE FROM f_receipt WHERE id='".$_GET['id']."'";
	if($result_add = mysqli_query($conn, $qry_add)){
		echo "<script>
		window.location.href = 'student_upload_receipt.php?action=msg_receipt_success_del';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'student_upload_receipt.php?action=msg_receipt_fail_del';
		</script>";
	}
}



if(isset($_GET['action']) && $_GET['action'] == 'delete'){
	$qry_add = "DELETE FROM f_receipt_detail WHERE id='".$_GET['id']."'";
	if($result_add = mysqli_query($conn, $qry_add)){
		echo "<script>
		window.location.href = 'student_upload_receipt.php?action=msg_receipt_success_del&id=$_GET[r_id]';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'student_upload_receipt.php?action=msg_receipt_fail_del&id=$_GET[r_id]';
		</script>";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'clear'){
	$qry_add = "DELETE FROM f_cart WHERE u_id = '".$_SESSION['id']."'";
	if($result_add = mysqli_query($conn, $qry_add)){
		echo "<script>
		window.location.href = 'student_upload_receipt.php?action=msg_receipt_success_clear';
		</script>";
	}else{
		echo "<script>
		window.location.href = 'f_student_receipt.php?action=msg_receipt_fail_clear';
		</script>";
	}
}

if(isset($_POST['submit']) && $_POST['submit'] == 'save'){
	/*if($c_rows > 0){*/
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
		if($_POST['p_type']=="Hostel Fee"){
			 $query_select="select h_status from student where id='".$_POST['name']."'";
			 
			$sttr_select=mysqli_query($conn,$query_select);
			$result_select=mysqli_fetch_array($sttr_select);
			 /*$sum_query="select sum(c_amount)as amount from f_cart where u_id='".$_SESSION['id']."'";
			$sttr_sum=mysqli_query($conn,$sum_query);
			$result_add=mysqli_fetch_array($sttr_sum);*/
			
			if($result_select['h_status']=='NO'){
				
				echo "<script>window.location.href='student_upload_receipt.php?action=meg_hostel_exis'</script>";
				break;
			}
			else{
                if($_POST['h_type'] == 1){
				    $status="YES";
                }else{
				    $status="NO";
                }
			}
			
			   
		}
		
        $price=$_POST['price'];
        $descriction="";
		$level=$_POST["level"];

		
		 $qry_save = "INSERT INTO f_receipt_student(r_date, pay_mtd, r_status, createdate, createby, receipt_type, cash_bill_option, s_id,remark)VALUES('".$_POST['date']."', '".$pay_mtd."', 'PENDING', '".DATE_TODAY."', '".$_SESSION['id']."', '".$_POST['c_type']."', '".$_POST['p_type']."', '".$_POST['sid']."', '".$_POST['remark']."')";
		if($result_save = mysqli_query($conn, $qry_save)){
			$r_id = mysqli_insert_id($conn);
			
			  
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
				$target_dir = "receipt/";
				$filename=basename($_FILES["receipt"]["name"]);

				$ext = explode(".", $_FILES['receipt']['name']);
				$ext = strtolower(array_pop($ext));
				
				$newfilename="p".date("YmdHis").$filename;
				$path=$target_dir.$newfilename;
				move_uploaded_file($_FILES["receipt"]["tmp_name"], $path);

				$qry_bankin = "INSERT INTO f_b_c(rs_id, cheque_no, banker, in_date, payment_reference,account)VALUES('".$r_id."', 'BANKIN', '".$_POST['bankin_banker']."', '".$_POST['bankin_date']."', '".$_POST['pr']."','$path')";
				
				

				if($result_bankin = mysqli_query($conn, $qry_bankin)){
					/*$qry = "SELECT * FROM f_cart WHERE u_id='".$_SESSION['id']."'";
					$result = mysqli_query($conn, $qry);*/
                    
                    foreach($_POST['desc'] as $index =>$code){
                        $descriction=$code." (".$level[$index].") ";

                        $qry_rd = "INSERT INTO f_receipt_detail(rs_id, rp_desc, rp_amount)VALUES('".$r_id."', '".$descriction."', '".$price[$index]."')";
                        if($result_rd = mysqli_query($conn, $qry_rd)){
                            echo "<script>
                            alert('success');
                                    window.location.href = 'student_upload_receipt.php?action=msg_choose&id=$r_id';
                            </script>";
                        }else{
                            echo "<script>
                            window.location.href = 'student_upload_receipt.php?action=msg_bankin_receipt_detail_fail_save';
                            </script>";
                        }
                    }
					
				}else{
					echo "<script>
					window.location.href = 'student_upload_receipt.php?action=msg_bankin_fail_save';
					</script>";
				}
			}elseif((isset($_POST['boc']) && $_POST['boc'] == 'c') || (isset($_POST["boc"]) && $_POST["boc"]=="cd") || (isset($_POST["boc"]) && $_POST["boc"]=="db")){
				$qry_cheque = "INSERT INTO f_b_c(r_id, cheque_no, banker, in_date)VALUES('".$r_id."', '".$_POST['c_no']."', '".$_POST['banker']."', '".$_POST['dated']."')";
				
				if($result_cheque = mysqli_query($conn, $qry_cheque)){
					/*$qry = "SELECT * FROM f_cart WHERE u_id='".$_SESSION['id']."'";
					$result = mysqli_query($conn, $qry);*/
                    foreach($_POST['desc'] as $index =>$code){
						$descriction=$code." (".$level[$index].") ";
						
                        $qry_rd = "INSERT INTO f_receipt_detail(r_id, rp_desc, rp_amount)VALUES('".$r_id."', '".$descriction."', '".$price[$index]."')";
                        if($result_rd = mysqli_query($conn, $qry_rd)){
                            echo "<script>
                            alert('success');
                                    window.location.href = 'student_upload_receipt.php?action=msg_choose&id=$r_id';
                            </script>";
                        }else{
                            echo "<script>
                            window.location.href = 'student_upload_receipt.php?action=msg_bankin_receipt_detail_fail_save';
                            </script>";
                        }
                    }
					
				}else{
					echo "<script>
					window.location.href = 'student_upload_receipt.php?action=msg_cheque_fail_save';
					</script>";
				}
			}else{
                
                foreach($_POST['desc'] as $index =>$code){
				
				$descriction=$code." (".$level[$index].") ";
						$qry_rd = "INSERT INTO f_receipt_detail(r_id, rp_desc, rp_amount)VALUES('".$r_id."', '".$descriction."', '".$price[$index]."')";
					if($result_rd = mysqli_query($conn, $qry_rd)){
                        echo "<script>
                                alert('success');
                                window.location.href = 'student_upload_receipt.php?action=msg_choose&id=$r_id';
                        </script>";
					}else{
						echo "<script>
						window.location.href = 'student_upload_receipt.php?action=msg_receipt_detail_fail_save';
						</script>";
					}
					
		}
				
			}
		}else{
			echo "<script>
			window.location.href = 'student_upload_receipt.php?action=msg_receipt_fail_save';
			</script>";
		}
	/*}else{
		echo "<script>
		window.location.href = 'f_receipt_form1.php?action=msg_cart_empty';
		</script>";
	}*/
}

?>