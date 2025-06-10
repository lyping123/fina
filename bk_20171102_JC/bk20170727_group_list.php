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
$qry = "SELECT * FROM student_group AS s
		INNER JOIN course AS c ON c.id = s.c_id
		WHERE s.g_status = 'ACTIVE' ORDER BY s.id,c.course DESC";
//$result = mysqli_query($conn, $qry);

$sql_page = mysqli_query($conn,$qry);
$num_page = mysqli_num_rows($sql_page);
$page_records = $num_page;

$page = new Page();
$links = new Pagination ($page_records,'50');
$limit = $links->limit();
	
$result = mysqli_query($conn,$qry.$limit);
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">PP List
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
                
                    <table id="mytable" class="table table-bordred table-striped" style="width:100%">
                    
                        <thead>
                            <th>Group</th>
                            <th>Course</th>
                            <th>Level</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
							<?php while($row = mysqli_fetch_array($result)){?>
                            <tr>
                            <td><?=$row['g_name']?></td>
                            <td><?=$row['course']?></td>
                            <td><?=$row['g_level']?></td>
                            <td>
                            <!--<div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action <span class="caret"></span>
                        </button>
                            <ul class="dropdown-menu  dropdown-menu-right">
                                <li><a href="" onclick="return confirm('Confirm to Delete this Record?')"> Delete </a></li>
                                <li class="divider"></li>
                                <li><a href="" onclick="return confirm('Confirm Receive?')"> Receive </a></li>
                            </ul>
                        </div>-->
                            </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                <!--</div>-->
            </div>
</div>
       

 
  <?php include('addon/pagination/pagination_footer.php');?>
  <!-- /.row -->
  <?php require('footer.php');?>
