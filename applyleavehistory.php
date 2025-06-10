<?php
include("include/sinclude.php");
require('header_student.php');
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
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_del_success'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully delete current record.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_del_fail'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to delete current record.');	
}

if(isset($_GET['sl_name']) && !empty($_GET['sl_name'])){
  $get_sl_name = $_GET['sl_name'];
}else{
  $get_sl_name = '';
}


$status = '';
$course = '';
$level = '';
$status1 = '';

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

<div class="container">
  <?php 
	if(isset($system_msg)){echo $system_msg;}
	
mysqli_set_charset($conn, 'utf8');
    
$qry="SELECT * FROM apply_leave_list AS al
	  INNER JOIN student AS s ON s.id = al.s_id
      WHERE al.s_id = '".$_SESSION['id']."' ORDER BY al.id DESC";
$result = mysqli_query($conn,$qry);
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">History
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
            <diw
</div>
<div class="row">
        	<div class="col-md-12">
                <!--<div class="table-responsive">-->
                
                    <table id="example1" class="table table-bordred table-striped" style="width:100%">
                    
                        <thead>
                          <th>Name</th>
                          <th>From</th>
                          <th>To</th>
                          <th>Leave Type</th>    
                          <th>Days</th>     
                          <th>Apply Date</th> 
                          <th>Reason</th> 
                          <th>Remark</th>     
                          <th>Status</th>   
                          <th>Attachment</th>     
                        </thead>
                        <tbody>
                          <style>
                            .bg-danger {
                                background-color: #dc3545 !important;
                            }	  
                          </style>
							<?php while($row = mysqli_fetch_array($result)){?>
                            <tr>
                              <td><?=$row['s_name']?></td>
                              <td><?=$row['a_from']?></td>   
                              <td><?=$row['a_to']?></td>     
                              <td><?=$row['a_leave_type']?></td>     
                              <td><?=$row['a_days']?></td>   
                              <td><?=$row['a_date']?></td>  
                              <td><?=$row['a_reason']?></td> 
                              <td><?=$row['a_remark']?></td> 
                              <td><?=$row['a_status']?></td>   
                              <td>
                                    <a href="<?=$row['a_photo']?>" target="_blank"><img src="<?=$row['a_photo']?>" style="height:  50px;"></a>
                              </td>      
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                <!--</div>-->
            </div>
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
