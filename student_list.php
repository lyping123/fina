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
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_q'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully set student status as quit.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_g'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully set student status as graduate.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_q'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to set student status as quit.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_g'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to set student status as graduate.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_reg'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully set student status as current student.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_reg'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to set this student status as current student.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_req'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully set student status as current student.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_req'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to set this student status as current student.');	
}

if(isset($_GET['sl_name']) && !empty($_GET['sl_name'])){
  $get_sl_name = $_GET['sl_name'];
}else{
  $get_sl_name = '';
}


$status = '';

$name_sl = mysqli_real_escape_string($conn,$get_sl_name);

if(isset($_GET['search']) && $_GET['search'] == 'search'){
	if(isset($_GET['status']) && $_GET['status'] == 'active'){
		$status .= " AND stu.s_status = 'ACTIVE' ";
	}elseif(isset($_GET['status']) && $_GET['status'] == 'graduate'){
		$status .= " AND stu.s_status = 'GRADUATE' ";
	}elseif(isset($_GET['status']) && $_GET['status'] == 'quit'){
		$status .= " AND stu.s_status = 'QUIT' ";
	}
		
}else{
    $status .= " AND stu.s_status = 'ACTIVE' ";
}
	
?>
<!-- Page Content -->

<div class="container-fluid">
  <?php 
	if(isset($system_msg)){echo $system_msg;}
	
mysqli_set_charset($conn, 'utf8');	


if(isset($_SESSION['level']) && $_SESSION['level'] == 'admin' || $_SESSION['level'] == 'superadmin'){
	$level = "";
}elseif($_SESSION['dp'] == 'Department Head'){
	$level = "AND c.id = '".$_SESSION['course']."'";
}elseif($_SESSION['dp'] == 'Department Lecturer'){
	$level = "AND stu.p_id = '".$_SESSION['id']."'";
}

/*$qry="SELECT * FROM student AS stu
      LEFT JOIN login AS l ON l.id = stu.p_id
	  LEFT JOIN school AS sch ON stu.id = sch.s_id
	  LEFT JOIN course AS c ON c.course = stu.course
      LEFT JOIN (SELECT *,MAX(id) AS new_id FROM student_group_list WHERE status = 'ACTIVE' GROUP BY s_id) AS sgl ON sgl.s_id = stu.id
      LEFT JOIN student_group AS sg on sg.id = sgl.g_id
	  WHERE stu.s_status != 'DELETE' AND (sch.status = 'ACTIVE' || sch.status is NULL) ".$level.$s_name.$sl_name."
	  ORDER BY stu.s_name ASC";
$qry="SELECT *, stu.course as new_course FROM student AS stu
	  LEFT JOIN school AS sch ON stu.id = sch.s_id
	  LEFT JOIN course AS c ON c.course = stu.course
      LEFT JOIN (SELECT *,MAX(id) AS new_id FROM student_group_list WHERE status = 'ACTIVE' GROUP BY s_id) AS sgl ON sgl.s_id = stu.id
      LEFT JOIN student_group AS sg on sg.id = sgl.g_id
	  WHERE (sch.status = 'ACTIVE' || sch.status is NULL) ".$level.$status."
	  ORDER BY stu.s_name ASC";*/
$qry="SELECT *, stu.course as new_course FROM student AS stu
	  LEFT JOIN school AS sch ON stu.id = sch.s_id
	  LEFT JOIN course AS c ON c.course = stu.course
    LEFT JOIN (SELECT MAX(sg.g_level) AS g_level, sgl.s_id, sg.g_name FROM student_group_list AS sgl
                 INNER JOIN student_group AS sg on sg.id = sgl.g_id
                 WHERE sgl.status = 'ACTIVE' GROUP BY sgl.s_id) AS sgll ON sgll.s_id = stu.id
	  WHERE (sch.status = 'ACTIVE' || sch.status is NULL) ".$level.$status."
	  ORDER BY stu.s_name ASC";
$result = mysqli_query($conn,$qry);
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Student List
            <!--<small>Secondary Text</small>-->
        </h1>
    </div>
    <!--<div class="col-md-12">	
        <div class="form-group">
            <form action="student_list.php" method="get">
                <div class="row">
                    <div class="col-lg-3">
                        <label>Search Student</label>
                        <div id="basic-example">
                            <input id="my-input1" class="form-control typeahead" name="name" type="text" value="" style="width:262.5px;" onfocusout="showHint(this.value);">
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
    </div>-->
    
    <div class="col-md-12">	
                <div class="form-group">
                    <form action="calculate_student.php" method="post">
                        <div class="row">
                            <div class="col-lg-3">
                                <label>Year</label>
                                <div id="basic-example">
									<select name="year" class="form-control" id="c_type" required>
                    <option value="">choose</option>
										<option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
									</select>
                                </div>
                            </div>
                        </div>
                        <br />
                    
                    <div style="padding: 19px 20px 20px;margin-top: 20px;    margin-bottom: 20px;background-color: #f5f5f5;border-top: 1px solid #e5e5e5;" class="form-group">
                      <div class="row">
                            <div class="col-lg-6">
                            <button type="submit" name="search" value="search" class="btn btn-primary" name="submit">Generate Student number list</button>
                            </div>
                      </div>
                    </div>
                    </form>
                </div>
            </div>

            <div class="col-md-12">	
                <div class="form-group">
                    <form action="student_list.php" method="get">
                        <div class="row">
                            <div class="col-lg-3">
                                <label>Search By Status</label>
                                <div id="basic-example">
									<select name="status" class="form-control" id="c_type" required>
										<option value="">Choose</option>
										<option value="active">Current Student</option>
										<option value="graduate">Graduate</option>
										<option value="quit">Quit</option>
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
</div>
<div class="row">
        	<div class="col-md-12">
                <!--<div class="table-responsive">-->
                    <table id="example1" class="table table-bordred table-striped" style="width:100%">
                        <thead>
                          <th>Student Id</th>
                          <th>Name</th>
                          <th>Chinese Name</th>
                          <th>IC</th>
                          <th>Gender</th>
                          <th>Home Address</th> 
                          <th>Contact(home)</th>
                          <th>Parents(hp)</th>      
                          <th>Course</th>     
                          <th>School</th>     
                          <th>Group Name</th> 
                          <th>Level</th>
                            
                          <th>Action</th>  
                            <?php 
                            if(isset($_GET['status']) && $_GET['status'] =='quit'){
                                echo "<th>Reason Quit</th>";
                                echo "<th>Quit Date</th>";
                                
                            }
                                
                            ?>
                        </thead>
                        <tbody>
                          <style>
                            .bg-danger {
                                background-color: #dc3545 !important;
                            }	  
                          </style>
							<?php while($row = mysqli_fetch_array($result)){?>
              <?php 
              $select="select * from family where s_id='".$row[0]."'";
              $sttr=mysqli_query($conn,$select);
              $f_row=mysqli_fetch_array($sttr);
                
              ?>
                            <tr <?php if($row['s_status'] == 'GRADUATE'){ echo 'style="background-color:  #dff0d8;"';}elseif($row['s_status'] == 'QUIT'){ echo 'style="background-color:  #dc3545;"';}else{ } ?>>
                              <td><?=$row[1]?></td>
                              <td><?=$row['s_name']?></td>
                              <td><?=$row['chinese_name']?></td>
                              <td><?=$row['ic']?></td>
                              <td><?=$row['gender']?></td>
                              <td><?=$row['r_address']?></td>     
                              <td><?=$row['h_contact']?></td>
                                  
                              <td><?=$row['hp_contact']?></td> 
                              
                              <td><?=$row['new_course']?></td>       
                              <td><?=$row['name_school']?></td>       
                              <td><?=$row['g_name']?></td>     
                              <td><?=$row['g_level']?></td>          

                              <td><div class="dropdown">
                                  <button class="btn btn-warning dropdown-toggle " type="button" data-toggle="dropdown">Action<span class="caret"></span></button>
                                  <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="student_edit.php?id=<?=$row[0]?>">Edit</a></li>
                                    <?php if(isset($_SESSION['level']) && $_SESSION['level'] == 'superadmin'){?>
                                    <li><a href="add_student.php?action=delete&id=<?=$row[0]?>" onclick="return confirm('Are you sure set thie student status as graduate?')">Delete</a></li>
                                    <?php }?>
                                    <!--<li class="divider"></li>
                                    <li><a href="internal_exam_fee_list.php?id=<?=$row[0]?>&name=<?=$row['s_name']?>&ic=<?=$row['ic']?>">Internal Exam Fees</a></li>
                                    <li><a href="tuition_fee_list.php?id=<?=$row[0]?>&name=<?=$row['s_name']?>&ic=<?=$row['ic']?>">Tuition Fees</a></li>
                                    <li><a href="hostel_fee_list.php?id=<?=$row[0]?>&name=<?=$row['s_name']?>&ic=<?=$row['ic']?>">Hostel Fees</a></li>-->
                                    <!-- <li class="divider"></li>
                                    <li><a href="family.php?&id=<?=$row[0]?>">Family</a></li>
                                    <li><a href="qualification.php?&id=<?=$row[0]?>">Qualification Status</a></li> -->
                                    <!--<li><a href="dateregister.php?&id=<?=$row[0]?>">Date Register</a></li>
                                    <li><a href="personal_form.php?&id=<?=$row[0]?>">Personal File</a></li>
                                    <li><a href="#">Offer Letter</a></li>
                                    <li><a href="#">Rapid Bus Letter</a></li>-->
                                    <li class="divider"></li>
                                  <?php if($row['s_status'] == 'ACTIVE'){?>
                                      <li><a href="#" data-title="Add" data-toggle="modal" data-target="#edit" id="edit_button" data-id="<?=$row[0]?>"> Quit </a></li>
                                  <?php }elseif($row['s_status'] == 'GRADUATE'){?>
                                      <li><a href="add_student.php?action=regraduate&id=<?=$row[0]?>" onclick="return confirm('Are you sure set this student as current student?')">Reactive</a></li>
                                  <?php }else{ ?>
                                      <li><a href="add_student.php?action=requit&id=<?=$row[0]?>" onclick="return confirm('Are you sure set this student as current student?')">Reactive</a></li>
                                    
                                  <?php }?>
                                    <li class="divider"></li>
                                    <?php if($row['s_status']=="ACTIVE"){ ?><li> <a href="add_student_job.php?action=graduate&id=<?=$row[0]?>" onclick="return confirm('Are you sure set thie student status as graduate?')">Graduate</a></li><?php } ?>
                                  </ul>
                                </div></td>  
                                  <?php if($row['s_status'] == 'QUIT'){?>
                                <td><?php echo $row['reason_quit'];?></td>
                                <td><?php echo $row['quit_date'];?>
                                  <?php }?>
                              </td>   
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                <!--</div>-->
            </div>
</div>
    
       
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog" style="width:1000px">
    <div class="modal-content">
          <form name="theForm" onSubmit="return(ValidateRequiredFields())" method="post" action="" id="editform">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Reason Quit</h4>
      </div>
          <div class="modal-body">

  <div class="row">
        <div class="col-md-12">
                <div class="form-group">
                    <label>Reason</label>
                    <input class="form-control" name="reason" type="text" value="" placeholder="" >
                </div>
                <div class="form-group">
                    <label>Quit Date</label>
                        <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input4<?=$row[0]?>" data-link-format="yyyy-mm-dd">
                        <input class="form-control" size="16" type="text" value="" >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        <input type="hidden" name="q_date" id="dtp_input4<?=$row[0]?>" value="" />
                </div>
        </div>
  </div>
          </div>
          <div class="modal-footer ">
			<button type="submit" id="update" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Submit </button>
          </div>
      		</form>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
<?php /*?>
<div class="row">
    <div class="col-md-12">	
        <div class="form-group">
            <form action="student_list.php" method="get">
                <div class="row">
                    <div class="col-lg-3">
                        <label>Search By Student</label><br>
						<select class="selectpicker" name="name" id="name" data-live-search="true">
						<option value="">Choose</option>
						<?php
						$s_qty = "SELECT id,s_name FROM student WHERE s_status != 'DELETE'";	
						$s_result = mysqli_query($conn, $s_qty);
						while($s_row = mysqli_fetch_array($s_result)){
						?>
						<option value="<?=$s_row['id']?>"><?=$s_row['s_name']?></option>
						<?php
						}
						?>
						</select>
                    </div>
                    <label>Search School</label>
                        <div id="basic-example">
                            <input id="my-input2" class="form-control typeahead" name="sl_name" type="text" value="<?=$get_sl_name?>" style="width:262.5px;" onfocusout="showHint1(this.value);">
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
   <table class="table table-bordered" style="border-collapse:collapse;">          
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
          <th>Graduate</th>
          <th>Quit</th>
          </tr>
          </thead>
          
          <tbody>
		  <style>
		  	.bg-danger {
				background-color: #dc3545 !important;
			}	  
		  </style>
		  <?php while($row = mysqli_fetch_array($result)){?>
          <tr data-toggle="collapse" data-target="#demo<?=$row[0]?>" class="accordion-toggle <?php if($row['s_status'] == 'GRADUATE'){ echo 'bg-success';}elseif($row['s_status'] == 'QUIT'){ echo 'bg-danger';}else{ echo 'bg-primary';} ?>">
            <td><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>
              <td><?=$row[1]?></td>
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
					<?php if(isset($_SESSION['level']) && $_SESSION['level'] == 'superadmin'){?>
                    <li><a href="add_student.php?action=delete&id=<?=$row[0]?>" onclick="return confirm('Are you sure set thie student status as graduate?')">Delete</a></li>
					<?php }?>
                    <!--<li class="divider"></li>
                    <li><a href="internal_exam_fee_list.php?id=<?=$row[0]?>&name=<?=$row['s_name']?>&ic=<?=$row['ic']?>">Internal Exam Fees</a></li>
                    <li><a href="tuition_fee_list.php?id=<?=$row[0]?>&name=<?=$row['s_name']?>&ic=<?=$row['ic']?>">Tuition Fees</a></li>
                    <li><a href="hostel_fee_list.php?id=<?=$row[0]?>&name=<?=$row['s_name']?>&ic=<?=$row['ic']?>">Hostel Fees</a></li>-->
                    <li class="divider"></li>
                    <li><a href="family.php?&id=<?=$row[0]?>">Family</a></li>
                    <li><a href="qualification.php?&id=<?=$row[0]?>">Qualification Status</a></li>
                    <!--<li><a href="dateregister.php?&id=<?=$row[0]?>">Date Register</a></li>
                    <li><a href="personal_form.php?&id=<?=$row[0]?>">Personal File</a></li>
                    <li><a href="#">Offer Letter</a></li>
                    <li><a href="#">Rapid Bus Letter</a></li>-->
                  </ul>
                </div></td>  
              
              <td><?php if($row['s_status'] != 'GRADUATE' && $row['s_status'] != 'QUIT'){?><a href="add_student.php?action=graduate&id=<?=$row[0]?>" class="btn btn-danger" onclick="return confirm('Are you sure set thie student status as graduate?')">Graduate</a><?php }elseif($row['s_status'] == 'GRADUATE'){ echo'YES';}?></td>  
              <td><?php if($row['s_status'] != 'QUIT' && $row['s_status'] != 'GRADUATE'){?><a href="add_student.php?action=quit&id=<?=$row[0]?>" class="btn btn-danger" onclick="return confirm('Are you sure set thie student status as quit?')">Quit</a><?php }elseif($row['s_status'] == 'QUIT'){ echo'YES';}?></td>         
          </tr>
          <tr>
          <td colspan="14" class="hiddenRow"><div class="accordian-body collapse" id="demo<?=$row[0]?>"> 
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
                <tr class="<?php if($row['s_status'] == 'GRADUATE'){ echo 'bg-success';}elseif($row['s_status'] == 'QUIT'){ echo 'bg-danger';}else{ echo 'bg-primary';} ?>">
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
<?php */?>
  <!-- /.row -->
  <?php require('footer.php');?>
<script>
    
$(document).on('click', '#edit_button', function() {
	var id = $(this).data('id');
	
	$('#editform').attr('action', "add_student.php?action=quit&id="+id).submit();
});
</script>
