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

	$qry_rcp = "SELECT 
                    f.id,
                    f.pay_mtd,
                    f.receipt_type,
                    l.l_name,
                    DATE(f.r_date) AS r_date,
                    IF(f.s_name <> '', f.s_name, s.s_name) AS s_name,
                    IF(f.s_ic <> '', f.s_ic, s.ic) AS s_ic,
                    GROUP_CONCAT(fr.rp_desc, '(RM ', fr.rp_amount, ')'
                        SEPARATOR '<hr>') AS descriptionn,
                    SUM(fr.rp_amount) AS total_amount,
                    IF(f.r_no <> '',
                        f.r_no,
                        IF(f.receipt_type = 1,
                            (SELECT 
                                    LPAD(COUNT(frrr.id) + 10000,
                                                7,
                                                CASE
                                                    WHEN f.cash_bill_option = 'Debtor' THEN ' D'
                                                    WHEN f.cash_bill_option = 'Locker' THEN ' L'
                                                END) AS r_no
                                FROM
                                    f_receipt AS frrr
                                WHERE
                                    frrr.r_status = 'ACTIVE'
                                        AND frrr.receipt_type = f.receipt_type
                                        AND frrr.cash_bill_option = f.cash_bill_option
                                        AND frrr.id BETWEEN 1 AND f.id),
                            (SELECT 
                                    LPAD(COUNT(frrr.id) + 10000,
                                                7,
                                                CASE
                                                    WHEN f.cash_bill_option = 'Debtor PTPK' THEN 'DP'
                                                    WHEN f.cash_bill_option = 'Debtor' THEN ' D'
                                                    WHEN f.cash_bill_option = 'Internal Exam Fee' THEN ' I'
                                                    WHEN f.cash_bill_option = 'Hostel Fee' THEN ' H'
                                                    WHEN f.cash_bill_option = 'Tuition PTPK' THEN 'TP'
                                                    WHEN f.cash_bill_option = 'Tuition Fee' THEN ' T'
                                                    WHEN f.cash_bill_option = 'Tuition PTPK Auto debit' THEN 'TPA'
                                                    WHEN f.cash_bill_option = 'Tuition PTPK Seft pay' THEN 'TPS'
                                                    WHEN f.cash_bill_option = 'Personal Bond' THEN ' P'
                                                    WHEN f.cash_bill_option = 'Enrollment Fee' THEN ' E'
                                                    WHEN f.cash_bill_option = 'Hostel Deposit' THEN 'HP'
                                                    WHEN f.cash_bill_option = 'laptop deposit' THEN 'LD'
                                                END) AS r_no
                                FROM
                                    f_receipt AS frrr
                                WHERE
                                    frrr.r_status = 'ACTIVE'
                                        AND frrr.receipt_type = f.receipt_type
                                        AND frrr.cash_bill_option = f.cash_bill_option
                                        AND frrr.id BETWEEN 1 AND f.id))) AS r_no
                FROM
                    f_receipt AS f
                        LEFT JOIN
                    student AS s ON s.id = f.s_id
                        INNER JOIN
                    f_receipt_detail AS fr ON fr.r_id = f.id
                        INNER JOIN
                    login AS l ON l.id = f.createby
                WHERE
                f.r_status = 'ACTIVE'".$c_type."
                GROUP BY f.id
                ORDER BY f.id DESC
                ";
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
                    <th>Payby</th>
                    <th>Create By</th>
                	<th>Print</th>
                    <?php if(isset($_SESSION['level']) && $_SESSION['level'] == 'superadmin'){?>
                	<th>Action</th>
                    <?php }?>
                </thead>
                <tbody>
                <?php while($row_rcp = mysqli_fetch_array($result_rcp)){   
                ?>
                	<tr>
                    	<td><?=$row_rcp['r_no']?></td>
                    	<td><?=$row_rcp['r_date']?></td>
                    	<td><?=$row_rcp['s_name']?></td>
                    	<td><?=$row_rcp['s_ic']?></td>
                        <td><?=$row_rcp['descriptionn']?></td>
                        <td>RM<?=$row_rcp['total_amount']?></td>
                        <td><?=$row_rcp['pay_mtd']?></td>
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
							<a href="f_print_receipt.php?&id=<?=$row_rcp[0]?>" target="_blank" class="btn btn-primary"><i class="icon-print"></i> Print</a>
							<?php }elseif($row_rcp['receipt_type'] == '2'){?>
							<a href="f_print_receipt1.php?&id=<?=$row_rcp[0]?>" target="_blank" class="btn btn-primary"><i class="icon-print"></i> Print</a>
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
                <?php }?>
                </tbody>
            
            </table>
            <!--</div>-->
            
        </div>
<?php require('footer.php');?>