<?php
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully add new student.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_login_success'){
	$system_msg .= systemMsg('alert-success','Welcome',$_SESSION['name']);	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_edit'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully edit student.');	
}

$s_name = '';
$sl_name = '';
if(isset($_GET['search']) && $_GET['search'] == 'search'){
	$s_name .= " AND s.s_name LIKE '%".$_GET['name']."%'";
	$sl_name.= " AND sch.name_school LIKE '%".$_GET['sl_name']."%'";
		
}else{
	$s_name = '';
	$sl_name = '';
} 
	
?>
<!-- Page Content -->

<div class="container-fluid">
  <?php 
	if(isset($system_msg)){echo $system_msg;}
	
mysqli_set_charset($conn, 'utf8');	


if(isset($_SESSION['level']) && $_SESSION['level'] == 'admin' || $_SESSION['level'] == 'superadmin'){
	$qry = "SELECT * FROM student AS s WHERE s.s_status = 'ACTIVE'".$s_name." ORDER BY s.id DESC";
    $Sqry="SELECT * FROM student AS stu
	 INNER JOIN school AS sch ON stu.id = sch.s_id
	 WHERE sch.status = 'ACTIVE'".$sl_name." GROUP BY stu.id DESC";
}elseif($_SESSION['dp'] == 'Department Head'){
	$qry = "SELECT * FROM student AS s
			INNER JOIN login AS l ON l.id = s.p_id
			WHERE s.s_status = 'ACTIVE' AND l.c_id = '".$_SESSION['course']."'".$s_name." ORDER BY s.id DESC";
    $Sqry="SELECT * FROM student AS stu
	 INNER JOIN school AS sch ON stu.id = sch.s_id
	 WHERE sch.status = 'ACTIVE'".$sl_name." GROUP BY stu.id DESC";
}elseif($_SESSION['dp'] == 'Department Lecturer'){
	$qry = "SELECT * FROM student AS s WHERE s.s_status = 'ACTIVE' AND s.p_id = '".$_SESSION['id']."'".$s_name." ORDER BY s.id DESC";
	$Sqry="SELECT * FROM student AS stu
	 INNER JOIN school AS sch ON stu.id = sch.s_id
	 WHERE sch.status = 'ACTIVE'".$sl_name." GROUP BY stu.id DESC";
}

//$result = mysqli_query($conn, $qry);

$sql_page = mysqli_query($conn,$qry);
$num_page = mysqli_num_rows($sql_page);
$page_records = $num_page;

$page = new Page();
$links = new Pagination ($page_records,'50');
$limit = $links->limit();
if(isset($_GET['name']) && $_GET['name'] == ''){	
	$result = mysqli_query($conn,$Sqry.$limit);
	
}elseif(isset($_GET['sl_name']) && $_GET['sl_name'] == ''){	
	$result = mysqli_query($conn,$qry.$limit);
	
}elseif(empty($_GET['name']) && empty($_GET['sl_name'])){
	$result = mysqli_query($conn,$Sqry.$limit);

}
else{
	$result = mysqli_query($conn,$qry.$limit);
	echo '4';
}
?>
<div class="row">
    <div class="col-md-12">	
        <div class="form-group">
            <form action="student_list.php" method="get">
                <div class="row">
                    <div class="col-lg-3">
                        <label>Search Student</label>
                        <div id="basic-example">
                            <input id="my-input1" class="form-control typeahead" name="name" type="text" value="" style="width:262.5px;" onfocusout="showHint(this.value);">
                        </div>
                    </div>
                    <label>Search School</label>
                        <div id="basic-example">
                            <input id="my-input2" class="form-control typeahead" name="sl_name" type="text" value="" style="width:262.5px;" onfocusout="showHint1(this.value);">
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
</div>

<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading"><h3>Student List</h3></div>
<div class="panel-body">
   <table class="table table-bordered" style="border-collapse:collapse;"  >          
          <thead>
          <tr><th>&nbsp;</th>
          <th>Student Id</th>
          <th>Name</th>
          <th>Chinese Name</th>
          <th>IC</th>
          <th>Birthday</th>
          <th>Age</th>
          <th>Nationality</th>
          <th>Gender</th>
          <th>Marital Status</th>
          <th>Race</th>          
          <th>Action</th>
          </tr>
          </thead>
          
          <tbody>
		  <?php while($row = mysqli_fetch_array($result)){?>
          <tr data-toggle="collapse" data-target="#demo<?=$row[0]?>" class="accordion-toggle  bg-primary">
            <td><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>
              <td><?=$row['s_id']?></td>
              <td><?=$row['s_name']?></td>
              <td><?=$row['chinese_name']?></td>
              <td><?=$row['ic']?></td>
              <td><?=$row['birthday']?></td>
              <td><?=$row['age']?></td>
              <td><?=$row['nationality']?></td>
              <td><?=$row['gender']?></td>              
              <td><?=$row['m_status']?></td> 
              <td><?=$row['race']?></td>
              
              <td><div class="dropdown">
                  <button class="btn btn-warning dropdown-toggle " type="button" data-toggle="dropdown">Action<span class="caret"></span></button>
                  <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="student_edit.php?id=<?=$row[0]?>">Edit</a></li>
                    <li><a href="add_student.php?action=delete&id=<?=$row[0]?>">Delete</a></li>
                    <!--<li class="divider"></li>
                    <li><a href="internal_exam_fee_list.php?id=<?=$row[0]?>&name=<?=$row['s_name']?>&ic=<?=$row['ic']?>">Internal Exam Fees</a></li>
                    <li><a href="tuition_fee_list.php?id=<?=$row[0]?>&name=<?=$row['s_name']?>&ic=<?=$row['ic']?>">Tuition Fees</a></li>
                    <li><a href="hostel_fee_list.php?id=<?=$row[0]?>&name=<?=$row['s_name']?>&ic=<?=$row['ic']?>">Hostel Fees</a></li>-->
                    <li class="divider"></li>
                    <li><a href="family.php?&id=<?=$row[0]?>">Family</a></li>
                    <li><a href="qualification.php?&id=<?=$row[0]?>">Qualification Status</a></li>
                    <li><a href="dateregister.php?&id=<?=$row[0]?>">Date Register</a></li>
                    <!--<li><a href="personal_form.php?&id=<?=$row[0]?>">Personal File</a></li>
                    <li><a href="#">Offer Letter</a></li>
                    <li><a href="#">Rapid Bus Letter</a></li>-->
                  </ul>
                </div></td>         
          </tr>
          <tr>
          <td colspan="12" class="hiddenRow"><div class="accordian-body collapse" id="demo<?=$row[0]?>"> 
              <table class="table table-bordered ">
              <thead > 
                <th></th>                    
               
                <th>Religion</th>
                <th>Residential Address</th>
                <th>Residential Postcode</th>
                <th>Residential State</th>
                <th>Corespondence Address</th>
                <th>Corespondence Postcode</th>
                <th>Corespondence State</th>
                <th>Contact(home)</th>
                <th>Contact(hp)</th>             
                <th>Date Join</th>
                <th>Course</th>
               
                </td></tr>
              </thead>
              <tbody>
                <tr class=" bg-primary">
                <td></td>
                <td><?=$row['religion']?></td>	   
                <td><?=$row['r_address']?></td>
                <td><?=$row['r_postcode']?></td>
                <td><?=$row['r_state']?></td>
                <td><?=$row['c_address']?></td>
                <td><?=$row['c_postcode']?></td>
                <td><?=$row['c_state']?></td>
                <td><?=$row['h_contact']?></td>
                <td><?=$row['hp_contact']?></td>              
                <td><?=$row['date_join']?></td>
                <td><?=$row['course']?></td>
                </tr>   
              </tbody>
          </table>
</div> </td>
               <?php }?>
         </tr>
            </tbody>
   </table>
</div>
</div> 
</div>
       

 
  <?php include('addon/pagination/pagination_footer.php');?>
  <!-- /.row -->
  <?php require('footer.php');?>
