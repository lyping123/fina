<?php
require('include/include.php');
require('header.php');
define('DATE_TODAY1', date('Y-m-d'));

$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully add new student.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_login_success'){
	$system_msg .= systemMsg('alert-success','Welcome',$_SESSION['name']);	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_del'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully delete Group.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_del'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to delete Group.');
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_upl'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully Upload Semester Break Document.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_upl'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to Upload Semester Break Document.');
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
    //and s.end_date < STR_TO_DATE('".DATE_TODAY1."', '%Y-%m-%d')
	$qry = "SELECT *,COUNT(sgl.s_id) AS total_student FROM student_group AS s
			INNER JOIN course AS c ON c.id = s.c_id
			LEFT JOIN login AS l ON l.id = s.p_id
			LEFT JOIN login AS l2 ON l2.id = s.jpk_pp_id
            LEFT JOIN (SELECT * FROM student_group_list WHERE status = 'ACTIVE') AS sgl ON sgl.g_id = s.id
			WHERE s.g_status = 'ACTIVE'  GROUP BY s.id ORDER BY s.end_date DESC";
}elseif($_SESSION['dp'] == 'Department Head'){
	$qry = "SELECT *,COUNT(sgl.s_id) AS total_student FROM student_group AS s
			INNER JOIN course AS c ON c.id = s.c_id
			LEFT JOIN login AS l ON l.id = s.p_id
			LEFT JOIN login AS l2 ON l2.id = s.jpk_pp_id
            LEFT JOIN (SELECT * FROM student_group_list WHERE status = 'ACTIVE') AS sgl ON sgl.g_id = s.id
			WHERE s.g_status = 'ACTIVE' AND c.id = '".$_SESSION['course']."' GROUP BY s.id ORDER BY s.end_date DESC";
}else{
	$qry = "SELECT *,COUNT(sgl.s_id) AS total_student FROM student_group AS s
			INNER JOIN course AS c ON c.id = s.c_id
			LEFT JOIN login AS l ON l.id = s.p_id
			LEFT JOIN login AS l2 ON l2.id = s.jpk_pp_id
            LEFT JOIN (SELECT * FROM student_group_list WHERE status = 'ACTIVE') AS sgl ON sgl.g_id = s.id
			WHERE s.g_status = 'ACTIVE' AND c.id = '".$_SESSION['course']."' AND s.p_id = '".$_SESSION['id']."' GROUP BY s.id ORDER BY s.end_date DESC";
}
$result = mysqli_query($conn,$qry);
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Group List
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
</div>
<div class="row">
        	<div class="col-md-12">
                <!--<div class="table-responsive">-->
                
                    <table id="example1" class="table table-bordred table-striped" style="width:100%">
                    
                        <thead>
                            <th>Group Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>College PP</th>
                            <th>JPK PP</th>
                            <th>Course</th>
                            <th>Level</th>
                            <th>Total Student</th>
                            <th>Status</th>
                            <th>S.B doc</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
							<?php while($row = mysqli_fetch_array($result)){?>
                            <tr>
                            <td><?=$row['g_name']?></td>
                            <td><?=$row['start_date']?></td>
                            <td><?=$row['end_date']?></td>
                            <td><?=$row[25]?></td>
                            <td><?=$row[34]?></td>
                            <td><?=$row['course']?></td>
                            <td><?php if($row['g_level'] == 'Single Tier'){ echo 'Level 4 ST';}else{ echo 'Level'.$row['g_level'];}?></td>
                            <td><?=$row['total_student']?></td>
                            <td><?php if(DATE_TODAY1 > $row['end_date']){ echo 'Expired';}else{ echo 'Active ';}?></td>
                            <td><?php if(!empty($row['sb_doc'])){?><a class="btn btn-success" href="https://docs.google.com/viewer?url=http://registration.synergy-college.org/<?=$row['sb_doc']?>" target="_blank"> View </a><?php }?></td>
                            <td>
                            <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action <span class="caret"></span>
                        </button>
                            <ul class="dropdown-menu  dropdown-menu-right">
                                <li><a href="edit_group.php?id=<?=$row[0]?>"> Edit </a></li>
                                <li><a href="add_group.php?id=<?=$row[0]?>&action=delete" onclick="return confirm('Confirm to Delete this Record?')"> Delete </a></li>
                                <li class="divider"></li>
                                <li><a href="g_signin_list.php?id=<?=$row[0]?>"> View </a></li>
                                <li class="divider"></li>
                                <li><a href="#" data-title="Upload" data-toggle="modal" data-target="#Upload<?=$row[0]?>"> Upload Semester Break </a></li>
                            </ul>
                        </div>
                            </td>
                            </tr>                      


<div class="modal fade" id="Upload<?=$row[0]?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog" style="width:1000px">
    <div class="modal-content">
          <form name="theForm" method="post" action="add_group.php?action=upload&id=<?=$row[0]?>" onSubmit="return(ValidateRequiredFields())" enctype="multipart/form-data" >
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Bulk Upload</h4>
      </div>
          <div class="modal-body">

            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group">
                        <label>Semester Break Document</label>
                        <input type="file" name="file" required>
                    </div>
                </div>
                
                <!--<div class="col-xs-2">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="submit_upload">
                            <span class="glyphicon glyphicon-ok"></span> Upload
                        </button>
                    </div>
                </div>-->
            </div>
          </div>
          <div class="modal-footer ">
			<button type="submit" class="btn btn-success btn-lg" style="width: 100%;" name="submit_upload"><span class="glyphicon glyphicon-ok-sign"></span> Add </button>
      </div>
      		</form>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
                            
                            <?php }?>
                        </tbody>
                    </table>
                <!--</div>-->
            </div>
</div>
       

  <!-- /.row -->
  <?php require('footer.php');?>
