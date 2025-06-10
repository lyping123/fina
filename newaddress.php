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


	
?>
<!-- Page Content -->

<div class="container-fluid">
  <?php 
	if(isset($system_msg)){echo $system_msg;}
	
mysqli_set_charset($conn, 'utf8');	

if(isset($_POST["submit"])){
    $qry_insert="insert into newaddress(s_id,phone_number,location,new_address) values('$_POST[s_name]','$_POST[p_num]','$_POST[location]','$_POST[newaddr]')";
    if($sttr_insert=mysqli_query($conn,$qry_insert)){
        echo "<script>
            alert('Submit success');
        </script>";
    }else{
        echo "<script>
            alert('Submit fail');
        </script>";
    }
}

if(isset($_GET["action"])&& $_GET["action"]=="delete"){
    $qry_delete="delete from newaddress where id='$_GET[id]'";
    if($sttr_delete=mysqli_query($conn,$qry_delete)){
        echo "<script>
            alert('Delete success');
        </script>";
    }else{
        echo "<script>
            alert('Delete fail');
        </script>";
    }
}


$qry="select * from newaddress as na inner join student as s on s.id=na.s_id";
$result = mysqli_query($conn,$qry);
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Student address List
            <!--<small>Secondary Text</small>-->
        </h1>
    </div>
    <form action="newaddress.php" method="post">
            <div class="col-md-12">	
               
                    <div class="form-group">
                    <div class="col-md-3">
                       <select class="selectpicker" name="s_name" id="name" data-live-search="true">
                        <option value="">Choose</option>
                        <?php 
                            $select="select * from student where s_status='ACTIVE' order by s_name";
                            $sttr=mysqli_query($conn,$select);
                            while($row=mysqli_fetch_array($sttr)){
                        ?>
                            <option value="<?=$row[0]?>"><?=$row["s_name"]?></option>
                            <?php } ?>
                       </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="p_num" value="" placeholder="Phone Number" />
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="location" value="" placeholder="State" /><br>
                        <textarea class="form-control" name="newaddr" value="" placeholder="Address"></textarea>
                    </div>
                    <div class="col-md-2">
                    
                      <div class="row">
                            <div class="col-lg-6">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary" name="submit">Submit</button>
                            </div>
                      </div>
                    
                    </div>
                    
               
                </div>
                
            </div>
            </form>
</div>
<br>
<br>
<div class="row">
        	<div class="col-md-12">
                <!--<div class="table-responsive">-->
                
                    <table id="example1" class="table table-bordred table-striped" style="width:100%">
                    
                        <thead>
                          <th>Student Name</th>
                          <th>Student Ic</th>
                          <th>Course</th>
                          <th>Phone Number</th>
                          <th>State</th>
                          <th>Living address now</th>
                          <th></th>  
                        </thead>
                        <tbody>
                            <?php while($n_row=mysqli_fetch_array($result)){ ?>
                                <tr>
                                    <td><?=$n_row["s_name"]?></td>
                                    <td><?=$n_row["ic"]?></td>
                                    <td><?=$n_row["course"]?></td>
                                    <td><?=$n_row["phone_number"]?></td>
                                    <td><?=$n_row["location"]?></td>
                                    <td><?=$n_row["new_address"]?></td>
                                    <td><a href="newaddress.php?action=delete&id=<?=$n_row[0]?>" onclick="return confirm('Are you sure you want to delete this address?')" class="btn btn-danger" >Delete</a></td>
                                </tr>
                            <?php } ?>
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
