<?php
require('include/db.php');
require('header.php');


$c_type = '';
if(isset($_GET['search']) && $_GET['search'] == 'search'){
	if(isset($_GET['c_type']) && !empty($_GET['c_type'])){
		$c_type = " AND f.receipt_type = '".$_GET['c_type']."'";
	}
}
if(isset($_POST["approve"])){
    $select="select * from f_receipt_student where id='".$_POST["approve"]."'";
    $sttr=mysqli_query($conn,$select);
    $result=mysqli_fetch_array($sttr);

    $qry="INSERT INTO f_receipt(r_date, pay_mtd, r_status, createdate, createby, receipt_type, cash_bill_option, s_id,remark)VALUES('$_POST[r_date]', '".$result['pay_mtd']."', 'ACTIVE', '".DATE_TODAY."', '".$_SESSION['id']."', '".$result['receipt_type']."', '".$result['cash_bill_option']."', '".$result['s_id']."', '".$result['remark']."')";
    if(mysqli_query($conn,$qry)){
        $last_id=mysqli_insert_id($conn);
        $update="update f_receipt_detail set r_id='$last_id' where rs_id='$_POST[approve]'";
        mysqli_query($conn,$update);
        $update1="update f_b_c set r_id='$last_id' where rs_id='$_POST[approve]'";
        mysqli_query($conn,$update1);
        $update1="update f_receipt_student set r_status='ACTIVE' where id='$_POST[approve]'";
        mysqli_query($conn,$update1);
        echo "<script>
            alert('receipt is approved');
            window.location.href='display_receipt.php'
        </script>";
    }else{
        echo "<script>
            alert('receipt approved fail');
            window.location.href='display_receipt.php'
        </script>";
    }
}
if(isset($_POST["reject"])){
    $qry="update f_receipt_student set r_status='DELETE' where id='$_POST[reject]'";
    if(mysqli_query($conn,$qry)){
        echo "<script>
            alert('receipt is rejected');
            window.location.href='display_receipt.php'
        </script>";
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
                                                END) AS r_no
                                FROM
                                    f_receipt AS frrr
                                WHERE
                                    frrr.r_status = 'ACTIVE'
                                        AND frrr.receipt_type = f.receipt_type
                                        AND frrr.cash_bill_option = f.cash_bill_option
                                        AND frrr.id BETWEEN 1 AND f.id))) AS r_no
                FROM
                    f_receipt_student AS f
                        LEFT JOIN
                    student AS s ON s.id = f.s_id
                        INNER JOIN
                    f_receipt_detail AS fr ON fr.rs_id = f.id
                WHERE
                f.r_status = 'PENDING'".$c_type."
                GROUP BY f.id
                ORDER BY f.id DESC
                ";
	$result_rcp = mysqli_query($conn,$qry_rcp);
	$total = '';
?>
<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                <p>Receipt approved page</p>
                </h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
            <form action="display_receipt.php" method="post">
            <div id="receipt">

            </div>
            </form>
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
                    
                	<th>choose</th>
                   
                </thead>
                <tbody>
                <?php while($row_rcp = mysqli_fetch_array($result_rcp)){   
                ?>
                	<tr>
                    	<td><?=$row_rcp['id']?></td>
                    	<td><?=$row_rcp['r_date']?></td>
                    	<td><?=$row_rcp['s_name']?></td>
                    	<td><?=$row_rcp['s_ic']?></td>
                        <td><?=$row_rcp['descriptionn']?></td>
                        <td>RM<?=$row_rcp['total_amount']?></td>
                        <td><?=$row_rcp['pay_mtd']?></td>
                    	
                    	<td>
                        <button type="button" class="btn btn-primary" name="choose" id="choose" onclick="loadDoc(this.value);" value='<?=$row_rcp["id"]?>'>Choose</button>	
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

<script>
function loadDoc(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("receipt").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "load_bank.php?id="+id, true);
  xhttp.send();
}

</script>

<?php require('footer.php');?>