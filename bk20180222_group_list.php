<?php
require('include/include.php');
require('header.php');
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
	$qry = "SELECT * FROM student_group AS s
			INNER JOIN course AS c ON c.id = s.c_id
			LEFT JOIN login AS l ON l.id = s.p_id
			LEFT JOIN login AS l2 ON l2.id = s.jpk_pp_id
			WHERE s.g_status = 'ACTIVE' ORDER BY s.end_date DESC";
}elseif($_SESSION['dp'] == 'Department Head'){
	$qry = "SELECT * FROM student_group AS s
			INNER JOIN course AS c ON c.id = s.c_id
			LEFT JOIN login AS l ON l.id = s.p_id
			LEFT JOIN login AS l2 ON l2.id = s.jpk_pp_id
			WHERE s.g_status = 'ACTIVE' AND c.id = '".$_SESSION['course']."' ORDER BY s.end_date DESC";
}else{
	$qry = "SELECT * FROM student_group AS s
			INNER JOIN course AS c ON c.id = s.c_id
			LEFT JOIN login AS l ON l.id = s.p_id
			LEFT JOIN login AS l2 ON l2.id = s.jpk_pp_id
			WHERE s.g_status = 'ACTIVE' AND c.id = '".$_SESSION['course']."' AND s.p_id = '".$_SESSION['id']."' ORDER BY s.end_date DESC";
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
                            <th>Action</th>
                        </thead>
                        <tbody>
							<?php while($row = mysqli_fetch_array($result)){?>
                            <tr>
                            <td><?=$row['g_name']?></td>
                            <td><?=$row['start_date']?></td>
                            <td><?=$row['end_date']?></td>
                            <td><?=$row[16]?></td>
                            <td><?=$row[25]?></td>
                            <td><?=$row['course']?></td>
                            <td><?=$row['g_level']?></td>
                            <td>
                            <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action <span class="caret"></span>
                        </button>
                            <ul class="dropdown-menu  dropdown-menu-right">
                                <li><a href="edit_group.php?id=<?=$row[0]?>"> Edit </a></li>
                                <li><a href="add_group.php?id=<?=$row[0]?>&action=delete" onclick="return confirm('Confirm to Delete this Record?')"> Delete </a></li>
                                <li class="divider"></li>
                                <li><a href="g_signin_list.php?id=<?=$row[0]?>"> Register Student In </a></li>
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
