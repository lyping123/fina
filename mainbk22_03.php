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
	 $qry_g="select *,i.date_join as jdate from internal_fee as i 
	inner join student as s on s.id=i.s_id 
	INNER JOIN course AS c ON c.course = s.course
	where i.pay_status='NO' and i.date_join>=".date("d-m-Y")." group by i.date_join";
	  $qry_t="select * from student as s left join tuitionfee_detail as td on td.s_id=s.id  where s.p_month>=1 and s.s_status='ACTIVE' and td.id in(select MAX(id) from tuitionfee_detail GROUP BY s_id)";
}elseif($_SESSION['dp'] == 'Department Head'){
	$qry = "SELECT s.id, s.s_name, s.s_status, s.ic, s.course FROM student AS s
			INNER JOIN course AS c ON c.course = s.course
			WHERE s.s_status = 'ACTIVE' AND c.id = '".$_SESSION['course']."' ORDER BY c.course,s.s_name ASC";
}else{
	$qry = "SELECT s.id, s.s_name, s.s_status, s.ic, s.course FROM student AS s
			INNER JOIN course AS c ON c.course = s.course
			WHERE s.s_status = 'ACTIVE' AND c.id = '".$_SESSION['course']."' ORDER BY c.course,s.s_name ASC";
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
        <h1 class="page-header">New Student Haven't Register Under JPK List
            <!--<small>Secondary Text</small>-->
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
							<td><a href="add_student.php?action=graduate&id=<?=$row[0]?>" class="btn btn-danger" onclick="return confirm('Are you sure set this student status as graduate?')">Graduate</a></td>
                            
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
        </h1>
    </div>
</div>
<div class="row">
        	<div class="col-md-12">
                <!--<div class="table-responsive">-->
                
                    <table id="example4" class="table table-bordred table-striped" style="width:100%">
                    
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
							while($row = mysqli_fetch_array($result)){
								/*$qry1 = "select * from internal_fee where pay_status='NO' and s_id='".$row['id']."'";
								$result1 = mysqli_query($conn, $qry1);
								$row1 = mysqli_fetch_array($result1);
								$rows1 = mysqli_num_rows($result1);*/
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
                            <?php }?>
                        </tbody>
                    </table>
                   </div> 
</div> 
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Tuition fee alert
            <!--<small>Secondary Text</small>-->
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
                            <th>Monthly Amount</th>
							<th>Last Pay date</th>
                        </thead>
                        <tbody>
							<?php 
							$result = mysqli_query($conn,$qry_t);
							while($row = mysqli_fetch_array($result)){
								/*$qry1 = "select * from internal_fee where pay_status='NO' and s_id='".$row['id']."'";
								$result1 = mysqli_query($conn, $qry1);
								$row1 = mysqli_fetch_array($result1);
								$rows1 = mysqli_num_rows($result1);*/
								
								$paymonth=$row['p_month'] * $row['cost_per_month'];
								if($paymonth>=1000){
									$class="remind";
								}
								else{
									$class="";
								}
								
							?>
                            <tr>
                            <td><?=$row['s_name']?></td>
                            <td><?=$row['ic']?></td>
                            <td><?=$row['course']?></td>
                            <td><?=$row['tuition_fee']?></td>
                            <td><?=$row['cost_per_month']?></td>
                            <td class="<?php echo $class; ?>"><?=$paymonth?></td>
                            <td><?=$row['rep_date']?></td>
                            
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                <!--</div>-->
                </div>
 </div>
            

  <!-- /.row -->
  <?php require('footer.php');?>
