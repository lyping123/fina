<?php 
include("include/include.php");
include("header.php");
$label='';
$textbox='';
$label1='';
$textbox1='';
$label2='';
$textbox2='';
$num1=0;
$td="";
$t_fee=0;
$tp_fee=0;
if(isset($_POST['search'])){
	 $query_new="select * from student where id='".$_POST['name']."'";
	 
	 if($_POST['p_type']!==""){
        if($_POST["p_type"]=="Tuition Fee"){
            $str="and (f.cash_bill_option='Tuition Fee' || f.cash_bill_option='Tuition PTPK' || f.cash_bill_option='Debtor' || f.cash_bill_option='Debtor PTPK')";
        }else{
            $str="and f.cash_bill_option='".$_POST['p_type']."'";
        }
	 
	 }
	 else{
	 	$str="";
	 }
	 
	     $qry="select sum(fd.rp_amount) from f_receipt as f inner join f_receipt_detail as fd on fd.r_id=f.id where f.s_id='".$_POST['name']."' and r_status='ACTIVE' ".$str."";
	
        $qry1="select * from f_receipt as f inner join f_receipt_detail as fd on fd.r_id=f.id where f.s_id='".$_POST['name']."'and r_status='ACTIVE' ".$str."";

        $qry2="SELECT SUM(fd.cn_amount) FROM f_cn as cn 
        INNER JOIN f_cn_detail as fd on fd.cn_id=cn.id
        WHERE cn.s_id='$_POST[name]' AND cn_status='ACTIVE' AND fd.cn_desc LIKE '%$_POST[p_type]%'";
        $sttr2=mysqli_query($conn,$qry2);
        $cn_price=mysqli_fetch_array($sttr2);
        $cn_row=mysqli_num_rows($sttr2);
        
        $sttr_amonth=mysqli_query($conn,$qry);
        $result_amonth=mysqli_fetch_array($sttr_amonth);
	 				$sttr=mysqli_query($conn,$query_new);
					$result_new=mysqli_fetch_array($sttr);
					$num1=mysqli_num_rows($sttr);
					$sttr1=mysqli_query($conn,$qry1);
					while($result1=mysqli_fetch_array($sttr1)){
                        if($result1['r_no'] == ''){
                            if($result1['cash_bill_option'] == 'Debtor PTPK'){
                                $type = 'DP';
                            }elseif($result1['cash_bill_option'] == 'Debtor'){
                                $type = 'D';
                            }elseif($result1['cash_bill_option'] == 'Internal Exam Fee'){
                                $type = 'I';
                            }elseif($result1['cash_bill_option'] == 'Hostel Fee'){
                                $type = 'H';
                            }elseif($result1['cash_bill_option'] == 'Tuition Fee'){
                                $type = 'T';
                            }elseif($result1['cash_bill_option'] == 'Tuition PTPK'){
                                $type = 'TP';
                                
                            }elseif($result1['cash_bill_option'] == 'Hostel Deposit'){
                                $type = 'HP';
                            }
                                $rno_qry = "SELECT count(fr.id) AS r_no FROM f_receipt AS fr WHERE fr.r_status = 'ACTIVE' AND fr.receipt_type = '".$result1['receipt_type']."' AND fr.cash_bill_option = '".$result1['cash_bill_option']."' AND fr.id BETWEEN 1 AND ".$result1[0];
                                $rno_result = mysqli_query($conn, $rno_qry);
                                $rno_row = mysqli_fetch_array($rno_result);
                                $r_no = 10000 + $rno_row['r_no'];
                                $r_no = $type.$r_no;
                            }else{
                                $r_no = $result1['r_no'];
                            }
                            if($result1['cash_bill_option'] == 'Tuition Fee'){
                                $t_fee+=$result1["rp_amount"];
                            }elseif($result1['cash_bill_option'] == 'Tuition PTPK'){
                                $tp_fee+=$result1["rp_amount"];
                            }
                        
					    $td.="<tr>";
                        $td.="<td>".$result1['r_date']."</td>";
                        $td.="<td>".$r_no."</td> ";
                        $td.="<td>".$result1['rp_desc']."</td>";
                        $td.="<td>".$result1['rp_amount']."</td>";
                        $td.="</tr>";
                        
					}
                    
					$amount=$result_new['tuition_fee']-$result1[0];
                    //echo "<script>alert('".$td."')</script>";
}


?>
<div class="container">
	<form action="student_payment.php" method="post">
	<div class="row">
    	<div class="col-md-12">
        	<div class="form-group">
            	<div class="row">
            	<div class="col-md-5">
                	<label>Student Name</label><br>
                    <select  class="selectpicker" name="name" id="name" data-live-search="true">
                    	<option>Choose</option>
                    	<?php 
						$query="select * from student where s_status='ACTIVE'";
						$sttr=mysqli_query($conn,$query);
						while($result=mysqli_fetch_array($sttr)){
							echo "<option value='".$result['id']."'>".$result['s_name']."</option>";
						}
						?>
                    </select>
                </div>
                <div class="col-md-5">
                	<label>Payment Option</label>
	<select name="p_type" id="bill_type" class="form-control" onChange="showbilldate(); return false;" required>
		<option value="Debtor PTPK" <?php if(isset($_POST['cbo']) && $_POST['cbo'] == 'Debtor PTPK'){ echo 'selected';}?>>Debtor PTPK</option>
		<option value="Debtor" <?php if(isset($_POST['cbo']) && $_POST['cbo'] == 'Debtor'){ echo 'selected';}?>>Debtor</option>
		<option value="Internal Exam Fee" <?php if(isset($_POST['cbo']) && $_POST['cbo'] == 'Internal Exam Fee'){ echo 'selected';}?>>Internal Exam Fee</option>
		<option value="Hostel Fee" <?php if(isset($_POST['cbo']) && $_POST['cbo'] == 'Hostel Fee'){ echo 'selected';}?>>Hostel Fee</option>
        <option value="Hostel Deposit" <?php if(isset($_POST['cbo']) && $_POST['cbo'] == 'Hostel Deposit'){ echo 'selected';}?>>Hostel Deposit</option>
		<option value="Tuition Fee" <?php if(isset($_POST['cbo']) && $_POST['cbo'] == 'Tuition Fee'){ echo 'selected';}?>>Tuition Fee</option>
        <option value="Enrollment Fee" <?php if(isset($_POST['cbo']) && $_POST['cbo'] == 'Enrollment Fee'){ echo 'selected';}?>>Enrollment Fee</option>
	</select>
                </div>
                <div class="col-md-2"></div>
                
                </div>
               
            </div>
             <div style="padding: 19px 20px 20px;margin-top: 20px;    margin-bottom: 20px;background-color: #f5f5f5;border-top: 1px solid #e5e5e5;" class="form-group">
              <div class="row">
                    <div class="col-lg-6">
                    <button type="submit" name="search" value="search" class="btn btn-primary" name="submit">Show payment</button>
                    </div>
              </div>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Payment Information</h3>
    </header>
    <div class="panel-body">
        <div class="col-md-12">
        	<table id="example1" class="table table-bordered" style="border-collapse:collapse;" >
            	<thead>
                	
                    <th>Student Name</th>
                    <th>Payment Type</th>
                    
                    <?php 
                    if(isset($_POST["p_type"]) && $_POST['p_type']=="Tuition Fee"){
                        
                    
                    ?>
                    <th>Tuition Fee</th>
                    <th>Total Paid</th>
                    <th>Outstanding</th>
                    <?php }else{echo "<th>Total Pay</th>";} ?>
                    
                    
                </thead>
                <tbody>
                    <tr>
                    
                    <?php 
					
					if($num1>0){
					
					
					?>
                    <td><?php echo $result_new['s_name'];?></td>
                    <td><?php echo $_POST['p_type']; ?></td>
                    
                    
                     <?php 
                        if($_POST['p_type']=="Tuition Fee"){
                            
                          
                    ?>
                    <td><?php echo $result_new['tuition_fee'] ?></td>
                    <td><?php echo $result_amonth[0]; ?></td>
                    <td><?php echo $result_new['tuition_fee']-$result_amonth[0]+$cn_price[0]; ?></td>
                    <?php }else{echo "<td>$result_amonth[0]</td>";}?>
                    <?php }else{ echo "<td colspan='5' style='text-align:center'>Please select student and payment</td>"; }?>
                    </tr>
                    <?php if($t_fee!==0 && $tp_fee!==0){ ?>
                    <tr>
                        <td colspan="3" style="text-align: right;">Tuition Fee</td>
                        <td><?=$t_fee?></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right;">Tuition PTPK</td>
                        <td><?=$tp_fee?></td>
                        <td colspan="2"></td>
                    </tr>
                    <?php } ?>
                    <?php if($cn_row!==0){ ?>
                        <td colspan="3" style="text-align: right;">Credit Note <?=$_POST["p_name"]?></td>
                        <td colspan="2">-<?=$cn_price[0]?></td>
                    <?php } ?>
                    
                    <tr class="hiddenRow">
                        <td></td>
                        <td colspan="5" >
                            <table class="table table-bordered">
                                <thead>
                                    <th>Date Receipt</th>
                                    <th>Receipt No</th>
                                    <th>Desc</th>
                                    <th>Amount</th>
                                </thead>
                                <tbody>
                                    <?php 
                                    if($td==""){
                                       
                                    }
                                    else{
                                        echo $td;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            
            </table>
        </div>
        
</div>
    </div>
    
    <?php include("footer.php");?>	
    </form>
</div>


