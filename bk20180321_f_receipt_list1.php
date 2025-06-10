<?php
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully add receipt.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add receipt.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_success_del'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully delete receipt.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_fail_del'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to delete receipt.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_success_clear'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully clear all receipt.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_fail_clear'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to clear all receipt.');	
}

$c_type = '';
if(isset($_GET['search']) && $_GET['search'] == 'search'){
	if(isset($_GET['c_type']) && !empty($_GET['c_type'])){
		$c_type = " AND f.receipt_type = '".$_GET['c_type']."'";
	}
}
?>
    <!-- Page Content -->
    <div class="container">
<?php 
	if(isset($system_msg)){echo $system_msg;}
	//$qry_rcp = "SELECT * FROM f_receipt WHERE r_status = 'ACTIVE'".$s_name." AND receipt_type = '1' ORDER BY id DESC";
	$qry_rcp = "SELECT *,f.s_name AS old_name FROM f_receipt AS f
				LEFT JOIN student AS s ON s.id = f.s_id
                INNER JOIN login AS l ON l.id = f.createby
				WHERE f.r_status = 'ACTIVE' ".$c_type."ORDER BY f.id DESC";
	$result_rcp = mysqli_query($conn,$qry_rcp);
	$total = '';
?>

		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                <p>Receipt List</p>
                </h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">	
                <div class="form-group">
                    <form action="f_receipt_list1.php" method="get">
                        <div class="row">
                            <div class="col-lg-3">
                                <label>Search By Cash Bill Type</label>
                                <div id="basic-example">
									<select name="c_type" class="form-control" id="c_type" required>
										<option value="">Choose</option>
										<option value="1">Pusat Kemahiran</option>
										<option value="2">Synergy Central</option>
									</select>
                                </div>
                            </div>
                        </div>
                        <br />
                    
                    <div style="padding: 19px 20px 20px;margin-top: 20px;    margin-bottom: 20px;background-color: #f5f5f5;border-top: 1px solid #e5e5e5;" class="form-group">
                      <div class="row">
                            <div class="col-lg-6">
                            <button type="submit" name="search" value="search" class="btn btn-primary" name="submit">Search</button>
                            </div>
                      </div>
                    </div>
                    </form>
                </div>
            </div>
            
            <!--<div style="overflow-x:auto;"> -->
            <table id="example1" class="table table-bordred table-striped" style="width:100%">
            	<thead>
                	<th>Receipt No.</th>
                	<th style="width: 90px;">Date</th>
                	<th>Name</th>
                	<th>IC</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Create By</th>
                	<th>Print</th>
                    <?php if(isset($_SESSION['level']) && $_SESSION['level'] == 'superadmin'){?>
                	<th>Action</th>
                    <?php }?>
                </thead>
                <tbody>
                <?php while($row_rcp = mysqli_fetch_array($result_rcp)){
						if($row_rcp['cash_bill_option'] == 'Debtor PTPK'){
							$type = 'DP';
						}elseif($row_rcp['cash_bill_option'] == 'Debtor'){
							$type = 'D';
						}elseif($row_rcp['cash_bill_option'] == 'Internal Exam Fee'){
							$type = 'I';
						}elseif($row_rcp['cash_bill_option'] == 'Hostel Fee'){
							$type = 'H';
						}elseif($row_rcp['cash_bill_option'] == 'Tuition Fee'){
							$type = 'T';
						}elseif($row_rcp['cash_bill_option'] == 'Tuition PTPK'){
							$type = 'TP';
						}
	
						if($row_rcp['r_no'] == ''){
							$rno_qry = "SELECT count(fr.id) AS r_no FROM f_receipt AS fr WHERE fr.r_status = 'ACTIVE' AND fr.receipt_type = '".$row_rcp['receipt_type']."' AND fr.cash_bill_option = '".$row_rcp['cash_bill_option']."' AND fr.id BETWEEN 1 AND ".$row_rcp[0];
							$rno_result = mysqli_query($conn, $rno_qry);
							$rno_row = mysqli_fetch_array($rno_result);
							$r_no = 10000 + $rno_row['r_no'];
							$r_no = $type.$r_no;
						}else{
							$r_no = $row_rcp['r_no'];
						}
	
						$rd_qry = "SELECT rp_desc,rp_amount FROM f_receipt_detail WHERE r_id = '".$row_rcp[0]."'";
						$rd_result = mysqli_query($conn,$rd_qry);
						while($rd_row = mysqli_fetch_array($rd_result)){
							$total[] = $rd_row['rp_amount'];
							$show_total = array_sum($total);
							$desc[] = $rd_row['rp_desc'];
							$show_desc = implode(',',$desc);
						}
							unset($desc);
							unset($total);
				?>
                	<tr>
                    	<td><?=$r_no?></td>
                    	<td><?=date('Y-m-d', strtotime($row_rcp['r_date']))?></td>
                    	<td><?php if($row_rcp['s_name'] == ''){ echo $row_rcp['old_name'];}else{ echo $row_rcp['s_name'];}?></td>
                    	<td><?php if($row_rcp['s_ic'] == ''){ echo $row_rcp['ic'];}else{ echo $row_rcp['s_ic'];}?></td>
                        <td><?=$show_desc?></td>
                        <td>RM<?=$show_total?></td>
                        <td><?=$row_rcp['l_name']?></td>
                    	
                    	<td>
                        <!--<div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Print <span class="caret"></span></button>
                          <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="f_print_receipt.php?&id=<?=$row_rcp[0]?>" target="_blank"><i class="icon-print"></i> Print (Synergy Central Academy)</a></li>
                            <li><a href="f_print_receipt1.php?&id=<?=$row_rcp[0]?>" target="_blank"><i class="icon-print"></i> Print (Pusat Kemahiran Telekomunikasi Mikro)</a></li>
                          </ul>
                        </div>-->
							<?php if($row_rcp['receipt_type'] == '1'){?>
							<a href="f_print_receipt1.php?&id=<?=$row_rcp[0]?>" target="_blank" class="btn btn-primary"><i class="icon-print"></i> Print</a>
							<?php }elseif($row_rcp['receipt_type'] == '2'){?>
							<a href="f_print_receipt.php?&id=<?=$row_rcp[0]?>" target="_blank" class="btn btn-primary"><i class="icon-print"></i> Print</a>
							<?php }?>
                        </td>
                    <?php if(isset($_SESSION['level']) && $_SESSION['level'] == 'superadmin'){?>
                        <td><div class="dropdown">
                  <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown"> Action <span class="caret"></span></button>
                  <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="f_receipt_edit1.php?&id=<?=$row_rcp[0]?>">Edit</a></li>
                    <li><a href="f_receipt1.php?action=delete_receipt&id=<?=$row_rcp[0]?>">Delete</a></li>
                  </ul>
                </div></td>
                    <?php }?>
                    </tr>
                <? }?>
                </tbody>
            
            </table>
            <!--</div>-->
            
        </div>
<?php require('footer.php');?>