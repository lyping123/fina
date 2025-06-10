<?php 
require ('header.php');


$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Job Tracer Successfully Add.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Job Tracer Fail To Add.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_login_success'){
	$system_msg .= systemMsg('alert-success','Success!','Welcome <strong>'.$_SESSION['name'].'</strong>');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_del'){
	$system_msg .= systemMsg('alert-success','Success!','Job Tracer Successfully Delete.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_edit'){
	$system_msg .= systemMsg('alert-success','Success!','Job Tracer Successfully Update.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_del'){
	$system_msg .= systemMsg('alert-danger','Success!','Job Tracer Fail To Delete.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_edit'){
	$system_msg .= systemMsg('alert-danger','Success!','Job Tracer Fail To Update.');	
}

$ic = '';
$name = '';
$contact = '';
$batch = '';

if(isset($_GET['search']) && $_GET['search'] == 'search'){
	if(isset($_GET['ic']) && !empty($_GET['ic'])){
		$ic .= " AND jt.s_ic LIKE '%".$_GET['ic']."%'";
	}else{
		$ic .= "";
	}
	
	if(isset($_GET['name']) && !empty($_GET['name'])){
		$name .= " AND new_name LIKE '%".clean($_GET['name'])."%'";
	}else{
		$name .= "";
	}
	
	if(isset($_GET['contact']) && !empty($_GET['contact'])){
		$contact .= " AND jt.s_contact LIKE '%".$_GET['contact']."%'";
	}else{
		$contact .= "";
	}

	if(isset($_GET['batch']) && !empty($_GET['batch'])){
		$batch .= " AND jt.batch LIKE '%".$_GET['batch']."%'";
	}else{
		$batch .= "";
	}
}
?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>

        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Job Tracer
                    <!--<small>Secondary Text</small>-->
                    <button class="btn btn-success pull-right" data-title="Add" data-toggle="modal" data-target="#add" type="button"><span class="glyphicon glyphicon-plus"></span> Add </button>
                </h1>


<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog" style="width:1000px">
    <div class="modal-content">
          <form method="post" action="add_jobtracer.php">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Add Job Tracer</h4>
      </div>
          <div class="modal-body">

  <div class="row">
        <div class="col-md-6">
        
            <div class="form-group">
            	<label>Student Name</label>
            	<input id="" class="form-control" name="s_name" type="text" placeholder="" required>
            </div> 
        
            <div class="form-group">
            	<label>Student Contact</label>
            	<input id="" class="form-control" name="s_contact" type="text" placeholder="e.g. 0123456789" required>
            </div> 
        
            <div class="form-group">
            	<label>Student IC</label>
            	<input id="" class="form-control" name="s_ic" type="text" placeholder="e.g. 923052074239" required>
            </div> 
        
            <div class="form-group">
            	<label>Company Name</label>
            	<input id="" class="form-control" name="c_name" type="text" placeholder="" required>
            </div> 
        
            <div class="form-group">
            	<label>Company Address</label>
            	<input id="" class="form-control" name="c_address" type="text" placeholder="" required>
            </div> 
        </div>
        
        <div class="col-md-6">
        
            <div class="form-group">
            	<label>Company Contact</label>
            	<input id="" class="form-control" name="c_contact" type="text" placeholder="e.g. 0123456789" required>
            </div> 
        
            <div class="form-group">
            	<label>Position</label>
            	<input id="" class="form-control" name="position" type="text" placeholder="" required>
            </div> 
        
            <div class="form-group">
            	<label>Salary</label>
            	<input id="" class="form-control" name="salary" type="text" placeholder="" required>
            </div>  
            
            <div class="form-group">
            	<label>Start Working Date</label>
                <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="" placeholder="" required="required">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" name="s_w_date" id="dtp_input" value="" />
            </div>
        
            <div class="form-group">
            	<label>Batch</label>
            	<input id="" class="form-control" name="batch" type="text" placeholder="e.g. 1" required>
            </div> 
              
        </div>
  </div>
          </div>
          <div class="modal-footer ">
			<button type="submit" name="add_jobtracer" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Add </button>
      </div>
      		</form>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>  
            </div>
        </div>
        <!-- /.row -->
        
<form action="" method="get">
  <div class="row">
    
    <div class="col-lg-3">
        <label>Search Name</label>
       <input class="form-control" name="name" type="text" >
        <label>Search IC</label>
       <input class="form-control" name="ic" type="text" >
    </div>
    
    <div class="col-lg-3">
        <label>Search Contact</label>
       <input class="form-control" name="contact" type="text" >
        <label>Search Batch</label>
       <input class="form-control" name="batch" type="text" >
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

        <!-- Projects Row -->
        <div class="row">
<?php
/*$qry="SELECT * FROM job_tracer AS jt
	  INNER JOIN course AS c ON c.id = jt.c_id
	  WHERE jt.j_status = 'ACTIVE' AND jt.c_id = '".$_SESSION['c_id']."'".$ic.$name.$contact.$batch."
	  ORDER BY jt.id DESC";*/
$qry="SELECT *,replace(jt.s_name, ' ', '') AS new_name FROM job_tracer AS jt
      
	  INNER JOIN course AS c ON c.id = jt.c_id
      INNER JOIN student as s on s.ic=jt.s_ic
	  HAVING jt.j_status = 'ACTIVE' AND jt.c_id = '".$_SESSION['c_id']."'".$ic.$name.$contact.$batch."
	  ORDER BY jt.batch ASC";
$sql_page = mysqli_query($conn,$qry);
$num_page = mysqli_num_rows($sql_page);
$page_records = $num_page;

$page = new Page();
$links = new Pagination ($page_records,'20');
$limit = $links->limit();
	
$result=mysqli_query($conn,$qry.$limit);
?>

            <div class="col-md-12">
                <div class="table-responsive">
                
                    <table id="mytable" class="table table-bordred table-striped" style="width:100%">
                    
                        <thead>
                            <!--<th>Course</th>-->
                            <th>Name</th>
                            <th>IC</th>
                            <th>Contact</th>
                            <th>Company Name</th>
                            <th>Company Address</th>
                            <th>Company Contact</th>
                            <th>Position</th>
                            <th>Salary</th>
                            <th>Graduation Date</th>
                            <th>Start Working Date</th>
                            <th>Batch</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
							<?php while($row = mysqli_fetch_array($result)){?>
                            <tr>
                            <!--<td><?=$row['c_name']?></td>-->
                            <td><?=$row['s_name']?></td>
                            <td><?=$row['s_ic']?></td>
                            <td><?=$row['s_contact']?></td>
                            <td><?=$row['company_name']?></td>
                            <td><?=$row['company_address']?></td>
                            <td><?=$row['company_contact']?></td>
                            <td><?=$row['position']?></td>
                            <td><?=$row['salary']?></td>
                            <td><?=$row['graduated_date']?></td>
                            <td><?=$row['start_working_date']?></td>
                            <td><?=$row['batch']?></td>
                            <td><button class="btn btn-primary" data-title="Add" data-toggle="modal" data-target="#edit<?=$row[0]?>" type="button"> Edit </button></td>
                            <td><a class="btn btn-danger" href="add_jobtracer.php?action=delete&id=<?=$row[0]?>" onclick="return confirm('Confirm to Delete this Record?')"> Delete </a></td>
                            </tr>
                            
<div class="modal fade" id="edit<?=$row[0]?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog" style="width:1000px">
    <div class="modal-content">
          <form method="post" action="add_jobtracer.php?action=edit&id=<?=$row[0]?>">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Edit Job Tracer</h4>
      </div>
          <div class="modal-body">

  <div class="row">
        <div class="col-md-6">
        
            <div class="form-group">
            	<label>Student Name</label>
            	<input value="<?=$row['s_name']?>" class="form-control" name="s_name" type="text" placeholder="" required>
            </div> 
        
            <div class="form-group">
            	<label>Student Contact</label>
            	<input value="<?=$row['s_contact']?>" class="form-control" name="s_contact" type="text" placeholder="e.g. 0123456789" required>
            </div> 
        
            <div class="form-group">
            	<label>Student IC</label>
            	<input value="<?=$row['s_ic']?>" class="form-control" name="s_ic" type="text" placeholder="e.g. 923052074239" required>
            </div> 
        
            <div class="form-group">
            	<label>Company Name</label>
            	<input value="<?=$row['company_name']?>" class="form-control" name="c_name" type="text" placeholder="" required>
            </div> 
        
            <div class="form-group">
            	<label>Company Address</label>
            	<input value="<?=$row['company_address']?>" class="form-control" name="c_address" type="text" placeholder="" required>
            </div> 
        </div>
        
        <div class="col-md-6">
        
            <div class="form-group">
            	<label>Company Contact</label>
            	<input value="<?=$row['company_contact']?>" class="form-control" name="c_contact" type="text" placeholder="e.g. 0123456789" required>
            </div> 
        
            <div class="form-group">
            	<label>Position</label>
            	<input value="<?=$row['position']?>" class="form-control" name="position" type="text" placeholder="" required>
            </div> 
        
            <div class="form-group">
            	<label>Salary</label>
            	<input value="<?=$row['salary']?>" class="form-control" name="salary" type="text" placeholder="" required>
            </div>  
            
            <div class="form-group">
            	<label>Start Working Date</label>
                <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input<?=$row[0]?>" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="<?=$row['start_working_date']?>" placeholder="" required="required">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" name="s_w_date" id="dtp_input<?=$row[0]?>" value="<?=$row['start_working_date']?>" />
            </div>
        
            <div class="form-group">
            	<label>Batch</label>
            	<input value="<?=$row['batch']?>" class="form-control" name="batch" type="text" placeholder="e.g. 1" required>
            </div> 
              
        </div>
  </div>
          </div>
          <div class="modal-footer ">
			<button type="submit" name="update_jobtracer" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> update </button>
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
                </div>
            </div>
        </div>
        <!-- /.row -->
<?php include('../addon/pagination/pagination_footer.php');?>
<?php 
require ('footer.php');
?>