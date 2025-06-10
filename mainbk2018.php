<?php
require('include/include.php');
require('header.php');

define('DATE', date('Y-m-d'));

$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully add new student.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_login_success'){
	$system_msg .= systemMsg('alert-success','Welcome',$_SESSION['name']);	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_del'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully delete Group.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_del'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to delete Group.');
}

$s_name = '';
if(isset($_GET['search']) && $_GET['search'] == 'search'){
	$s_name .= " AND s_name LIKE '%".$_GET['name']."%'";
}else{
	$s_name = '';
}
?>
<!-- Page Content -->

<div class="container-fluid">
  <?php 
	if(isset($system_msg)){echo $system_msg;}
	
mysqli_set_charset($conn, 'utf8');	
if(isset($_SESSION['level']) && $_SESSION['level'] == 'admin' || $_SESSION['level'] == 'superadmin'){
	$qry = "SELECT s.id, s.s_name, s.s_status, s.ic, s.course FROM student AS s
			INNER JOIN course AS c ON c.course = s.course
			WHERE s.s_status = 'ACTIVE' ORDER BY c.course,s.s_name ASC";
	   /*$qry_g="SELECT *, stu.course as new_course FROM student AS stu
	  LEFT JOIN course AS c ON c.course = stu.course
      LEFT JOIN (SELECT MAX(sg.g_level) AS g_level, sgl.id, sgl.s_id,sg.g_name,sg.end_date as e_date,sg.c_id, sg.start_date AS s_date FROM student_group_list AS sgl
                    INNER JOIN student_group AS sg on sg.id = sgl.g_id
                    WHERE sgl.status = 'ACTIVE' GROUP BY sgl.s_id) AS sgll ON sgll.id = stu.id
	  WHERE stu.s_status = 'ACTIVE' and stu.int_outstanding>=0
	  ORDER BY stu.s_name ASC";*/
      $qry_g="SELECT *, stu.course as new_course FROM student AS stu
      LEFT JOIN (SELECT sg1.g_level, tt.s_id, sg1.g_name , sg1.start_date as s_date, sg1.end_date as e_date , sg1.c_id as c_id
                FROM student_group_list AS tt
                INNER JOIN student_group AS sg1 on sg1.id = tt.g_id
                INNER JOIN
                    (SELECT MAX(sg.g_level) AS g_level, sgl.id, sgl.s_id FROM student_group_list AS sgl
                    INNER JOIN student_group AS sg on sg.id = sgl.g_id
                    WHERE sgl.status = 'ACTIVE' GROUP BY sgl.s_id) groupedtt ON tt.s_id = groupedtt.s_id 
                WHERE sg1.g_level = groupedtt.g_level AND tt.status = 'ACTIVE') AS sgll ON sgll.s_id = stu.id
	  WHERE stu.s_status = 'ACTIVE' and stu.int_outstanding>=0
	  ORDER BY stu.s_name ASC";
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
<style>
@keyframes example {
    	from {background-color: #d9534f;}
    	to {background-color: #fff;}
		
		
	} 
	.remind{
		animation-name: example;
    	animation-duration:1s;
		animation-iteration-count: infinite;
	}

</style>
    
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Student Not Yet Register Under Courses
            <!--<small>Secondary Text</small>-->
            <a class="btn btn-primary pull-right" href="print_alert.php?action=course" target="_blank"><span class="glyphicon glyphicon-plus"></span> Print </a>
        </h1>
    </div>
</div>
<div class="row">
        	<div class="col-md-12">
                <!--<div class="table-responsive">-->
                
                    <table id="example7" class="table table-bordred table-striped" style="width:100%">
                    
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
                <!--</div>-->
            </div>
</div>
    
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">New Student Haven't Register Under JPK List
            <!--<small>Secondary Text</small>-->
            <a class="btn btn-primary pull-right" href="print_alert.php?action=jpk" target="_blank"><span class="glyphicon glyphicon-plus"></span> Print </a>
        </h1>
    </div>
</div>
<div class="row">
        	<div class="col-md-12">
                <!--<div class="table-responsive">-->
                
                    <table id="example1" class="table table-bordred table-striped" style="width:100%">
                    
                        <thead>
                            <th>Student</th>
                            <th>IC</th>
                            <th>Course</th>
                        </thead>
                        <tbody>
							<?php while($row = mysqli_fetch_array($result)){
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
                <!--</div>-->
            </div>
</div>
	
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Student JPK Date Expired List
            <!--<small>Secondary Text</small>-->
            <a class="btn btn-primary pull-right" href="print_alert.php?action=exp" target="_blank"><span class="glyphicon glyphicon-plus"></span> Print </a>
        </h1>
    </div>
</div>
<div class="row">
        	<div class="col-md-12">
                <!--<div class="table-responsive">-->
                
                    <table id="example2" class="table table-bordred table-striped" style="width:100%">
                    
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
                <!--</div>-->
            </div>
</div>
	
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Fresh Graduate Student List
            <!--<small>Secondary Text</small>-->
            <a class="btn btn-primary pull-right" href="print_alert.php?action=graduate" target="_blank"><span class="glyphicon glyphicon-plus"></span> Print </a>
        </h1>
    </div>
</div>
<div class="row">
        	<div class="col-md-12">
                <!--<div class="table-responsive">-->
                
                    <table id="example3" class="table table-bordred table-striped" style="width:100%">
                    
                        <thead>
                            <th>Student</th>
                            <th>IC</th>
                            <th>Course</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Level</th>
							<th>Graduate</th>
                        </thead>
                        <tbody>
							<?php 
							$result = mysqli_query($conn,$qry);
							while($row = mysqli_fetch_array($result)){
								$qry1 = "SELECT sg.start_date, sg.end_date, sgl.s_id, sg.p_id, sg.g_level FROM student_group AS sg
										INNER JOIN student_group_list AS sgl ON sgl.g_id = sg.id
										WHERE sg.g_status = 'ACTIVE' AND sgl.status = 'ACTIVE' AND sgl.s_id = '".$row[0]."' AND (sg.g_level =  '4' || sg.g_level =  'Single Tier') 
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
							<td><a href="add_student_job.php?action=graduate&id=<?=$row[0]?>" class="btn btn-danger" onclick="return confirm('Are you sure set this student status as graduate?')">Graduate</a></td>
                            
                            </tr>
                            <?php }}?>
                        </tbody>
                    </table>
                <!--</div>-->
            </div>
</div> 
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Internal Exam fee alert
            <!--<small>Secondary Text</small>-->
            <a class="btn btn-primary pull-right" href="print_alert.php?action=ifee" target="_blank"><span class="glyphicon glyphicon-plus"></span> Print </a>
        </h1>
    </div>
</div>
<div class="row">
        	<div class="col-md-12">
                <!--<div class="table-responsive">-->
                
                    <table id="example4" class="table table-bordred table-striped" style="width:100%">
                    
                        <thead>
                            <th>Student</th>
                            <th>Course</th>
                            <th>Group name</th>
                            <th>level</th>
                            <th>Course start date</th>
                            <th>Course end date</th>
							<th>Payment date</th>
                            <th>Last payment amount</th>
                            <th>outstanding fee</th>
                        </thead>
                        <tbody>
							<?php 
							$result = mysqli_query($conn,$qry_g);
							$i=0;
							while($row = mysqli_fetch_array($result)){
								/*$qry1 = "select * from internal_fee where pay_status='NO' and s_id='".$row['id']."'";
								$result1 = mysqli_query($con`n, $qry1);
								$row1 = mysqli_fetch_array($result1);
								$rows1 = mysqli_num_rows($result1);*/
                                $i+=1;
                                $date=date("Y-m-d",strtotime("2018-10-17"));
								$qry_ini="select *, sum(fl.rp_amount) as amo from f_receipt as f inner join f_receipt_detail as fl on fl.r_id=f.id where f.s_id='".$row[0]."' and (f.cash_bill_option='Internal Exam Fee')";
                                $sttr=mysqli_query($conn,$qry_ini);
                                $row_sttr=mysqli_fetch_array($sttr);
                                $amo=$row_sttr["amo"];
                                $total=$row["int_outstanding"]-$amo;
								if($i>0){
									
								
							?>
                            <tr>
                            <td><?=$row['s_name']?></td>
                            <td><?=$row['course']?></td>
                            <td><?=$row['g_name']?></td>
                            <td><?=$row['g_level']?></td>
                            <td><?=$row['s_date']?></td>
                            <td><?=$row['e_date']?></td>
                            <td><?php echo $newdate=date("d-m-Y",strtotime($row_sttr['createdate']));?></td>
                            <td><?=$row_sttr["rp_amount"]?></td>
                            <td><?php if($total<0){echo 0;}else{echo $total;} ?></td>
                            
                            </tr>
                            <?php }}?>
                        </tbody>
                    </table>
                   </div> 
</div> 
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Tuition fee alert
            <!--<small>Secondary Text</small>-->
            <a class="btn btn-primary pull-right" href="print_alert.php?action=tfee" target="_blank"><span class="glyphicon glyphicon-plus"></span> Print </a>
        </h1>
    </div>
</div>
<div class="row">
        	<div class="col-md-12">
<table id="example5" class="table table-bordred table-striped" style="width:100%">
                    
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
									$paymonth=$row['tuition_fee_left'];
									
									
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
                            <td class="<?php echo $class; ?>"><?=$paymonth?></td>
                           
                            <td><?=$row1['l_date']?></td>
                            
                            </tr>
                            <?php }?>
                            <?php }}?>
                        </tbody>
                    </table>
                <!--</div>-->
                </div>
 </div>

    
<style>
.blink_me {
	background-color: #ff3333  !important;
    -webkit-animation-name: blinker;
    -webkit-animation-duration: 1s;
    -webkit-animation-timing-function: linear;
    -webkit-animation-iteration-count: infinite;

    -moz-animation-name: blinker;
    -moz-animation-duration: 2s;
    -moz-animation-timing-function: linear;
    -moz-animation-iteration-count: infinite;

    animation-name: blinker;
    animation-duration: 2s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
}

@-moz-keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}

@-webkit-keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}

@keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}
        }
</style>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Hostel Up Coming Payment
            <!--<small>Secondary Text</small>-->
            <a class="btn btn-primary pull-right" href="print_alert.php?action=hfee" target="_blank"><span class="glyphicon glyphicon-plus"></span> Print </a>
        </h1>
    </div>
</div>
<div class="row">
        	<div class="col-md-12">
<table id="example6" class="table table-bordred table-striped" style="width:100%">
                    
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
                <!--</div>-->
                </div>
 </div>
            

  <!-- /.row -->
  <?php require('footer.php');?>
