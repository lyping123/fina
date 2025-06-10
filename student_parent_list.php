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
$qry="select * from student as s left join family as f on f.s_id = s.id  where s.s_status='ACTIVE'";
$result=mysqli_query($conn,$qry);
	
?>
<div class="container">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Famaily List
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
            <!-- <div class="col-md-12">	
                <div class="form-group">
                    <form action="student_list.php" method="get">
                        <div class="row">
                            <div class="col-lg-3">
                                <label>Search By Status</label>
                                <div id="basic-example">
									<select name="name" class="form-control" id="c_type" required>
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
            </div> -->
</div>
<div class="row">
        	<div class="col-md-12">
                <!--<div class="table-responsive">-->
                
                    <table id="example1" class="table table-bordred table-striped" style="width:100%">
                    
                        <thead>
                          <th>Student Name</th>
                          <th>IC</th>
                          <th>Contact Number</th>
                          <th>Famaily Name</th>
                          <th>Relationship</th>  
                          <th>Parent contact</th>    
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
                            <tr>
                              
                              <td><?=$row['s_name']?></td>
                              <td><?=$row['ic']?></td>   
                              <td><?=$row['hp_contact']?></td>         
                              <td><?=$row['Name']?></td>          
                              <td><?=$row['relationship']?></td> 
                              <td><?=$row['Mobile_No']?></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                <!--</div>-->
            </div>
    </div>
</div>
<?php 
include("footer.php");
?>
    