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
$cdate="AND f.r_date='".date("Y-m-d")."'";
if(isset($_GET['search']) && $_GET['search'] == 'search'){
	if(isset($_GET['c_type']) && !empty($_GET['c_type'])){
		$c_type = " AND f.cash_bill_option = '".$_GET['c_type']."'";
	}

    if(isset($_GET['s_date']) && !empty($_GET["s_date"]) && isset($_GET['e_date']) && !empty($_GET["e_date"])){
		$cdate = " AND (f.r_date >= '".$_GET['s_date']."' AND f.r_date<='".$_GET["e_date"]."')";
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
                    f.cash_bill_option,
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
                f.r_status = 'ACTIVE'".$c_type." $cdate
                GROUP BY f.id
                ORDER BY f.id DESC
                ";
	$result_rcp = mysqli_query($conn,$qry_rcp);
	$total = '';
?>

		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                <p>Check Receipt List</p>
                </h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">	
                <div class="form-group">
                    <form action="check_receipt.php" method="get">
                        <div class="row">
                            <div class="col-lg-3">
                                <label>Search By Cash Bill Type</label>
                                <div id="basic-example">
									<select name="c_type" class="form-control" id="c_type" required>
                                    <option value="Debtor PTPK" <?php if(isset($_GET['c_type']) && $_GET['c_type'] == 'Debtor PTPK'){ echo 'selected';}?>>Debtor PTPK</option>
                                    <option value="Debtor" <?php if(isset($_GET['c_type']) && $_GET['c_type'] == 'Debtor'){ echo 'selected';}?>>Debtor</option>
                                    <option value="Internal Exam Fee" <?php if(isset($_GET['c_type']) && $_GET['c_type'] == 'Internal Exam Fee'){ echo 'selected';}?>>Internal Exam Fee</option>
                                    <option value="Hostel Fee" <?php if(isset($_GET['c_type']) && $_GET['c_type'] == 'Hostel Fee'){ echo 'selected';}?>>Hostel Fee</option>
                                    <option value="Hostel Deposit" <?php if(isset($_GET['c_type']) && $_GET['c_type'] == 'Hostel Deposit'){ echo 'selected';}?>>Hostel Deposit</option>
                                    <option value="Tuition Fee" <?php if(isset($_GET['c_type']) && $_GET['c_type'] == 'Tuition Fee'){ echo 'selected';}?>>Tuition Fee</option>
                                    <option value="Enrollment Fee" <?php if(isset($_GET['c_type']) && $_GET['c_type'] == 'Enrollment Fee'){ echo 'selected';}?>>Enrollment Fee</option>
									</select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label>Start date</label>
                <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="" placeholder="" required="required">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" name="s_date" id="dtp_input1" value="" />
                            </div>
                            <div class="col-lg-3">
                            <label>End Date</label>
                <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="" placeholder="" required="required">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" name="e_date" id="dtp_input2" value="" />
                            </div>
                        </div>
                        <br />
                    
                    <div style="padding: 19px 20px 20px;margin-top: 20px;    margin-bottom: 20px;background-color: #f5f5f5;border-top: 1px solid #e5e5e5;" class="form-group">
                      <div class="row">
                            <div class="col-lg-12">
                            <button type="submit" name="search" value="search" class="btn btn-primary" name="submit">Search</button>

                            <a href="print_summary.php?c_type=<?=$_GET["c_type"]?>&&s_date=<?=$_GET["s_date"]?>&&e_date=<?=$_GET["e_date"]?>" target="_BLANK" class="btn btn-primary pull-right" >Print summary</a>
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
                    <th>Cash Bill Type</th>
                    <th>Price</th>
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
                        <td><?=$row_rcp['cash_bill_option']?></td>
                        <td>RM<?=$row_rcp['total_amount']?></td>
                    	<td>
                        <!--<div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Print <span class="caret"></span></button>
                          <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="f_print_receipt.php?&id=<?=$row_rcp[0]?>" target="_blank"><i class="icon-print"></i> Print (Synergy Central Academy)</a></li>
                            <li><a href="f_print_receipt1.php?&id=<?=$row_rcp[0]?>" target="_blank"><i class="icon-print"></i> Print (Pusat Kemahiran Telekomunikasi Mikro)</a></li>
                          </ul>
                        </div>-->
							
							<a href="f_print_receipt.php?&id=<?=$row_rcp[0]?>" target="_blank" class="btn btn-primary"><i class="icon-print"></i> Print</a>
							
							<!-- <a href="f_print_receipt1.php?&id=<?=$row_rcp[0]?>" target="_blank" class="btn btn-primary"><i class="icon-print"></i> Print</a> -->

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
            <script>
$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
</script>
        </div>
<?php require('footer.php');?>