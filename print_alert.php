<?php
include_once('include/db.php');

define('DATE', date('Y-m-d'));
mysqli_set_charset($conn, 'utf8');	
if(isset($_SESSION['level']) && $_SESSION['level'] == 'admin' || $_SESSION['level'] == 'superadmin'){
    $qry = "SELECT s.id, s.s_name, s.s_status, s.ic, s.course FROM student AS s
            INNER JOIN course AS c ON c.course = s.course
            WHERE s.s_status = 'ACTIVE' ORDER BY c.course,s.s_name ASC";
     $qry_g="select *,i.date_join as jdate from internal_fee as i 
    inner join student as s on s.id=i.s_id 
    INNER JOIN course AS c ON c.course = s.course
    where i.pay_status='NO' and i.date_join>=".date("d-m-Y")." group by i.date_join";
       $qry_t="select *,s.rep_date as newdate from student as s  where s.outstanding>=0 and s.s_status='ACTIVE' or s.p_method='l_payment' order  by s.p_method desc";
      //and td.id in(select MAX(id) from tuitionfee_detail GROUP BY s_id)left join tuitionfee_detail as td on td.s_id=s.id
}elseif($_SESSION['dp'] == 'Department Head'){
    $qry = "SELECT s.id, s.s_name, s.s_status, s.ic, s.course FROM student AS s
            INNER JOIN course AS c ON c.course = s.course
            WHERE s.s_status = 'ACTIVE' AND c.id = '".$_SESSION['course']."' ORDER BY c.course,s.s_name ASC";
            $qry_g="select *,i.date_join as jdate from internal_fee as i 
    inner join student as s on s.id=i.s_id 
    INNER JOIN course AS c ON c.course = s.course
    where i.pay_status='NO' and i.date_join<=".date("d-m-Y")." group by i.date_join";
             $qry_t="select *,s.rep_date as newdate from student as s  where s.p_month>=1 and s.s_status='ACTIVE'";
}else{
    $qry = "SELECT s.id, s.s_name, s.s_status, s.ic, s.course FROM student AS s
            INNER JOIN course AS c ON c.course = s.course
            WHERE s.s_status = 'ACTIVE' AND c.id = '".$_SESSION['course']."' ORDER BY c.course,s.s_name ASC";
            $qry_g="select *,i.date_join as jdate from internal_fee as i 
    inner join student as s on s.id=i.s_id 
    INNER JOIN course AS c ON c.course = s.course
    where i.pay_status='NO' and i.date_join<=".date("d-m-Y")." group by i.date_join";
             $qry_t="select *,s.rep_date as newdate from student as s  where s.p_month>=1 and s.s_status='ACTIVE'";
}
$result = mysqli_query($conn,$qry);   
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pre Register List</title>
</head>

<body onload="window.print()">
<div style=" width:100%; margin-left:auto; margin-right:auto;">

  
<style type="text/css" media="print">
    @page 
    {
        size:  landscape;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }

    html
    {
        background-color: #FFFFFF; 
        margin: 0px;  /* this affects the margin on the html before sending to printer */
    }

    body
    {
        /*border: solid 1px blue ;*/
        margin: 10mm 5mm 10mm 5mm; /* margin you want for the content */
		-webkit-print-color-adjust:exact;
    }
</style>

<style>

table {
    border-collapse: collapse;
	font-size: 11px;
}

table, th, td {
    border: 1px solid black;
}
</style>
<?php
    if(isset($_GET['action']) && $_GET['action'] == 'course'){
?>
    <div style="display:inline-block; padding:0px 20px">
    	<p><small><span style="font-size:24px; font-weight:bold">Student Not Yet Register Under Courses</span></small>
    </div>
    
    <div class="table-responsive">
        <table id="mytable" class="table table-bordred table-striped" style="width:100%;text-align:  center;">
            <thead>
                <th>Student</th>
                <th>IC</th>
                <th>Course</th>
            </thead>
                        <tbody>
							<?php 
								$qry11 = "SELECT * FROM student AS s
                                         LEFT JOIN (SELECT * FROM f_receipt GROUP BY s_id ORDER BY id ASC) AS f ON f.s_id = s.id 
                                         WHERE s.course = 'Testing' AND s.s_status = 'ACTIVE' 
                                         ORDER BY s.s_name ASC";
								$result11 = mysqli_query($conn, $qry11);
								while($row11 = mysqli_fetch_array($result11)){
    
                                $date = new DateTime($row11['createdate']);
                                $date->modify('+14 day');
                                $date->format('Y-m-d');
                                $date_now = new DateTime();
    
								
							?>
                            <tr class="<?php if($date_now > $date){ echo 'blink_me';}?>">
                            <td><?=$row11[2]?></td>
                            <td><?=$row11['ic']?></td>
                            <td><?=$row11['course']?></td>
                            
                            </tr>
                            <?php }?>
                        </tbody>
        </table>
    </div>
<?php }elseif(isset($_GET['action']) && $_GET['action'] == 'jpk'){?>
    <div style="display:inline-block; padding:0px 20px">
    	<p><small><span style="font-size:24px; font-weight:bold">New Student Haven't Register Under JPK List</span></small>
    </div>
    
    <div class="table-responsive">
        <table id="mytable" class="table table-bordred table-striped" style="width:100%;text-align:  center;">
            <thead>
                <th>Student</th>
                <th>IC</th>
                <th>Course</th>
            </thead>
            <tbody>
                <?php             
                    while($row = mysqli_fetch_array($result)){
                    $qry1 = "SELECT sg.start_date, sg.end_date, sgl.s_id, sg.p_id FROM student_group AS sg
                            INNER JOIN student_group_list AS sgl ON sgl.g_id = sg.id
                            WHERE sg.g_status = 'ACTIVE' AND sgl.status = 'ACTIVE' AND sgl.s_id = '".$row[0]."' 
                            ORDER BY sg.g_level DESC LIMIT 1";
                    $result1 = mysqli_query($conn, $qry1);
                    $row1 = mysqli_fetch_array($result1);
                    $rows1 = mysqli_num_rows($result1);
                    if($rows1 == 0){
                ?>
                <tr>
                <td><?=$row['s_name']?></td>
                <td><?=$row['ic']?></td>
                <td><?=$row['course']?></td>

                </tr>
                <?php }}?>
            </tbody>
        </table>
    </div>
<?php }elseif(isset($_GET['action']) && $_GET['action'] == 'exp'){?>
    <div style="display:inline-block; padding:0px 20px">
    	<p><small><span style="font-size:24px; font-weight:bold">Student JPK Date Expired List</span></small>
    </div>
    
    <div class="table-responsive">
        <table id="mytable" class="table table-bordred table-striped" style="width:100%;text-align:  center;">
            <thead>
                <th>Student</th>
                <th>IC</th>
                <th>Course</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Level</th>
            </thead>
            <tbody>
                <?php 
                $result = mysqli_query($conn,$qry);
                while($row = mysqli_fetch_array($result)){
                    $qry1 = "SELECT sg.start_date, sg.end_date, sgl.s_id, sg.p_id, sg.g_level FROM student_group AS sg
                            INNER JOIN student_group_list AS sgl ON sgl.g_id = sg.id
                            WHERE sg.g_status = 'ACTIVE' AND sgl.status = 'ACTIVE' AND sgl.s_id = '".$row[0]."'
                            ORDER BY sg.g_level DESC LIMIT 1";
                    $result1 = mysqli_query($conn, $qry1);
                    $row1 = mysqli_fetch_array($result1);
                    $rows1 = mysqli_num_rows($result1);
                    if($rows1 != 0 && $row1['end_date'] < DATE && ($row1['g_level'] == '2'	 || $row1['g_level'] == '3')){
                ?>
                <tr>
                <td><?=$row['s_name']?></td>
                <td><?=$row['ic']?></td>
                <td><?=$row['course']?></td>
                <td><?=$row1['start_date']?></td>
                <td><?=$row1['end_date']?></td>
                <td><?=$row1['g_level']?></td>

                </tr>
                <?php }}?>
            </tbody>
        </table>
    </div>
<?php }elseif(isset($_GET['action']) && $_GET['action'] == 'ifee'){?>
    <div style="display:inline-block; padding:0px 20px">
    	<p><small><span style="font-size:24px; font-weight:bold">Internal Exam fee alert</span></small>
    </div>
    
    <div class="table-responsive">
        <table id="mytable" class="table table-bordred table-striped" style="width:100%;text-align:  center;">
            <thead>
                <th>Student</th>
                <th>IC</th>
                <th>Course</th>
                <th>Payment Start date</th>
                <th>Amount</th>
                <th>Level</th>
                <th>Day Pass</th>
            </thead>
            <tbody>
                <?php 
                $result = mysqli_query($conn,$qry_g);
                $i=0;
                while($row = mysqli_fetch_array($result)){
                    /*$qry1 = "select * from internal_fee where pay_status='NO' and s_id='".$row['id']."'";
                    $result1 = mysqli_query($conn, $qry1);
                    $row1 = mysqli_fetch_array($result1);
                    $rows1 = mysqli_num_rows($result1);*/
                    $i+=1;
                    $sec=strtotime($row['jdate']);
                    $sec_t=strtotime(date('d-m-Y'));
                    $total=$sec_t-$sec;
                    $day=$total/86400;
                    if($day>=30){
                        $class="remind";
                    }
                    else{
                        $class="";
                    }
                    if($i>0){


                ?>
                <tr>
                <td><?=$row['s_name']?></td>
                <td><?=$row['ic']?></td>
                <td><?=$row['course']?></td>
                <td><?=$row['jdate']?></td>
                <td><?=$row['amount']?></td>
                <td><?=$row['s_level']?></td>
                <td class="<?=$class?>"><?php echo $day; ?></td>
                </tr>
                <?php }}?>
            </tbody>
        </table>
    </div>
<?php }elseif(isset($_GET['action']) && $_GET['action'] == 'graduate'){?>
    <div style="display:inline-block; padding:0px 20px">
    	<p><small><span style="font-size:24px; font-weight:bold">Fresh Graduate Student List</span></small>
    </div>
    
    <div class="table-responsive">
        <table id="mytable" class="table table-bordred table-striped" style="width:100%;text-align:  center;">
            <thead>
                <th>Student</th>
                <th>IC</th>
                <th>Course</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Level</th>
            </thead>
            <tbody>
                <?php 
                $result = mysqli_query($conn,$qry);
                while($row = mysqli_fetch_array($result)){
                    $qry1 = "SELECT sg.start_date, sg.end_date, sgl.s_id, sg.p_id, sg.g_level FROM student_group AS sg
                            INNER JOIN student_group_list AS sgl ON sgl.g_id = sg.id
                            WHERE sg.g_status = 'ACTIVE' AND sgl.status = 'ACTIVE' AND sgl.s_id = '".$row[0]."' AND g_level = '4' || g_level = 'Single Tier' 
                            ORDER BY sg.g_level DESC LIMIT 1";
                    $result1 = mysqli_query($conn, $qry1);
                    $row1 = mysqli_fetch_array($result1);
                    $rows1 = mysqli_num_rows($result1);
                    if($rows1 != 0 && $row1['end_date'] < DATE){
                ?>
                <tr>
                <td><?=$row['s_name']?></td>
                <td><?=$row['ic']?></td>
                <td><?=$row['course']?></td>
                <td><?=$row1['start_date']?></td>
                <td><?=$row1['end_date']?></td>
                <td><?=$row1['g_level']?></td>

                </tr>
                <?php }}?>
            </tbody>
        </table>
    </div>
<?php }elseif(isset($_GET['action']) && $_GET['action'] == 'tfee'){?>
    <div style="display:inline-block; padding:0px 20px">
    	<p><small><span style="font-size:24px; font-weight:bold">Tuition fee alert</span></small>
    </div>
    
    <div class="table-responsive">
        <table id="mytable" class="table table-bordred table-striped" style="width:100%;text-align:  center;">
            <thead>
                <th>Student</th>
                <th>IC</th>
                <th>Course</th>
                <th>Amount</th>
                <th>Payment Per Month</th>
                <th>Balance Left</th>
                <th>Outstanding</th>
                <th>Last Pay date</th>
            </thead>
                        <tbody>
							<?php 
							$result = mysqli_query($conn,$qry_t);
							$ii=0;
							while($row = mysqli_fetch_array($result)){
								$qry1 = "SELECT *, max(DATE(r_date)) AS l_date FROM f_receipt WHERE s_id = '".$row[0]."' GROUP BY s_id";
								$result1 = mysqli_query($conn, $qry1);
								$row1 = mysqli_fetch_array($result1);
								$rows1 = mysqli_num_rows($result1);
                                $date=date("Y-m-d",strtotime("2018-10-17"));
                                $qry2="select *, sum(fl.rp_amount) as amo from f_receipt as f inner join f_receipt_detail as fl on fl.r_id=f.id where f.s_id='".$row[0]."' and (f.cash_bill_option='Debtor' or f.cash_bill_option='Tuition Fee') and Date(r_date)>='".$date."'";
                                $result2=mysqli_query($conn,$qry2);
                                $row2=mysqli_fetch_array($result2);
                                $qry3="select sum(fl.rp_amount) as amo from f_receipt as f inner join f_receipt_detail as fl on fl.r_id=f.id where f.s_id='".$row[0]."' and (f.cash_bill_option='Debtor' or f.cash_bill_option='Tuition Fee' or f.cash_bill_option='Tuition PTPK' or f.cash_bill_option='Deptor PTPK') and Date(r_date)>='".date('2018-12-18')."'";
                                $result3=mysqli_query($conn,$qry3);
                                $row3=mysqli_fetch_array($result3);
                                $total_o=$row2['amo'];
								$ii+=1;
                                $total_tui=$row["outstanding"]-$row2["amo"];
								if($row['p_method']=="l_payment"){
									
									$cospermonth="Last Payment";
									$paymonth=$row['tuition_fee_left']-$row3['amo'];
									
									
								}else{
                                    if($total_tui<0){
                                        $paymonth=0;
                                    }
                                    else{
                                        $paymonth=$total_tui; 
                                    }
									
									$cospermonth=$row['cost_per_month'];
								}
								/*if($row['p_month']>0){
									$paymonth+=$row['p_month'] * $row['cost_per_month'];
								}*/if($paymonth>0){
									$class="remind";
								}
								else{
									$class="";
								}
									
								
								if($ii>0){
								
								
							?>
                            <?php if($row['course'] != 'Testing'){?>
                            <tr>
                            <td><?=$row['s_name']?></td>
                            <td><?=$row['ic']?></td>
                            <td><?=$row['course']?></td>
                            <td><?=$row['tuition_fee']?></td>
                            <td><?php echo $cospermonth; ?></td>
                            <td><?php $left=$row['tuition_fee_left']-$row3['amo'];if($left<=0){echo 0;}else{echo $left;} ?></td>
                            <td class="<?php echo $class; ?>"><?php if($paymonth<=0){echo 0;}else{echo $paymonth;}?></td>
                            <td><?=$row['newdate']?></td>
                            
                            </tr>
                            <?php }?>
                            <?php }}?>
                        </tbody>
        </table>
    </div>
<?php }elseif(isset($_GET['action']) && $_GET['action'] == 'hfee'){?>
    <div style="display:inline-block; padding:0px 20px">
    	<p><small><span style="font-size:24px; font-weight:bold">Hostel Up Coming Payment</span></small>
    </div>
    
    <div class="table-responsive">
        <table id="mytable" class="table table-bordred table-striped" style="width:100%;text-align:  center;">
            <thead>
                <th>Student Name</th>
                <th>Course</th>
                <th>PP</th>
                <th>Hostel Address</th>
                <th>Amount</th>
                <th>Last Payment Date</th>
                <th>Pay Until Month</th>
                <th>Next Payment Date</th>
            </thead>
            <tbody>
                <?php 

                 $hqry = "SELECT * FROM duration  d 
                        INNER JOIN student AS s ON s.id = d.studentid
                        inner join student_detail as st on st.s_id=s.id
                        INNER JOIN hostel AS hostel ON hostel.id = st.h_id
                        LEFT JOIN login AS l ON l.id = s.p_id
                        WHERE d.status = 'ACTIVE' AND d.next_payment != 'LAST PAYMENT' 
                        and st.s_status<>'DELETE'
                        AND d.id IN (SELECT MAX(id) FROM duration GROUP BY studentid)
                        ORDER BY STR_TO_DATE(d.next_payment,'%d-%m-%Y') ASC";
                $hresult = mysqli_query($conn, $hqry);
                $ii=0;
                while($hrow = mysqli_fetch_array($hresult)){
                    if (strtotime($hrow['next_payment']) > strtotime('14 days'))
                    {
                        //echo "<script>alert('".$str."')</script>";
                        ?>
                        <tr studentid="<?= $hrow['studentid'] ?>" durationid="<?= $hrow['durationid'] ?>">
                            <td><?= $hrow['s_name'] ?></td>
                            <td><?= $hrow['course'] ?></td>
                            <td><?= $hrow['pp_name'] ?></td>
                            <td><?= $hrow['h_address'] ?></td>
                            <td><?= $hrow['amount'] ?></td>
                            <td><?= $hrow['paymentDate'] ?></td>
                            <td><?= $hrow['pay_until'] ?></td>
                            <td><?= $hrow['next_payment'] ?></td>

                        </tr>
                        <?php
                    } else
                    {
                        ?>
                        <tr studentid="<?= $hrow['studentid'] ?>" durationid="<?= $hrow['durationid'] ?>">
                            <td><?= $hrow['s_name'] ?></td>
                            <td><?= $hrow['course'] ?></td>
                            <td><?= $hrow['pp_name'] ?></td>
                            <td><?= $hrow['h_address'] ?></td>
                            <td><?= $hrow['amount'] ?></td>
                            <td><?= $hrow['paymentDate'] ?></td>
                            <td><?= $hrow['pay_until'] ?></td>
                            <td class="blink_me"><?= $hrow['next_payment'] ?></td>

                        </tr>
                        <?php
                    } }?>
            </tbody>
        </table>
    </div>
<?php }?>
</div>
</body>
</html>