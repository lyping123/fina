<?php
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully add new student.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_login_success'){
	$system_msg .= systemMsg('alert-success','Welcome',$_SESSION['name']);	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_del'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully delete Verification .');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_del'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to delete Verification .');
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

if(isset($_SESSION['dp']) && $_SESSION['dp'] == 'Department Head'){
	$course .= " AND c_id = '".$_SESSION['course']."'";
}else{
	$course = '';
}
	
$qry = "SELECT * FROM verification AS v
		LEFT JOIN student AS s ON s.id = v.s_name
		INNER JOIN course AS c ON c.id = v.department
		WHERE v.v_status = 'ACTIVE'";
$result = mysqli_query($conn,$qry);
?>
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <!--<small>Secondary Text</small>-->
			  <div class="pull-left">
				  <h1>Student Verification List</h1>
			  </div>
			  <div class="pull-right">
				  <form method="post" action="print_verification.php">
					<label>Course</label>
					<select name="course" class="form-control" required>
						<option value="">Choose</option>
						<option value="All">All</option>
						<option value="Accounting">Accounting</option>
						<option value="Electronic">Electronic</option>
						<option value="Multimedia">Multimedia</option>
						<option value="Networking">Networking</option>
						<option value="Programming">Programming</option>
					</select>
				  	<button type="submit" class="btn btn-primary">Print</button>
				  </form>
			  </div>
			  <div class="clearfix"></div>
        </div>
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
</div>
<div class="row">
        	<div class="col-md-12">
                <!--<div class="table-responsive">-->
                
                    <table id="example1" class="table table-bordred table-striped" style="width:100%">
                    
                        <thead>
                            <th>Student</th>
                            <th>IC</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Department</th>
                            <th>Course Name</th>
                            <!--<th>CGPA S1</th>
                            <th>CGPA S2</th>
                            <th>CGPA S3</th>
                            <th>CGPA S4</th>
                            <th>CGPA S5</th>-->
                            <th>CGPA</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
							<?php while($row = mysqli_fetch_array($result)){?>
                            <tr>
                            <td><?php if(!empty($row['s_name'])){ echo $row['s_name'];}else{ echo $row[1];}?></td>
                            <td><?=$row['s_ic']?></td>
                            <td><?=$row['s_date']?></td>
                            <td><?=$row['e_date']?></td>
                            <td><?=$row['course']?></td>
                            <td><?=$row['course_name']?></td>
                            <!--<td><?=$row['s1']?></td>
                            <td><?=$row['s2']?></td>
                            <td><?=$row['s3']?></td>
                            <td><?=$row['s4']?></td>
                            <td><?=$row['s5']?></td>-->
                            <td><?=$row['s5']?></td>
                            <td>
                            <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action <span class="caret"></span>
                        </button>
                            <ul class="dropdown-menu  dropdown-menu-right">
                                <li><a href="edit_verification.php?id=<?=$row[0]?>"> Edit </a></li>
                                <li><a href="verification.php?id=<?=$row[0]?>&action=delete" onclick="return confirm('Confirm to Delete this Record?')"> Delete </a></li>
                            </ul>
                        </div>
                            </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                <!--</div>-->
            </div>
</div>
       

  <!-- /.row -->
  <?php require('footer.php');?>
