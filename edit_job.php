<?php 
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add new student.');
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add1'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to update visitor details after add new student.');
}
$id=$_GET['id'];

$query="select * from job_tracer where id='$id'";
$sttr=mysqli_query($conn,$query);
$row=mysqli_fetch_array($sttr);
?>
<div class="container">
<?php 
	if(isset($system_msg)){echo $system_msg;}
?>
	<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">JOB TRACER EDIT FORM
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
  	<div class="panel panel-info">
    	<header class="panel-heading">
    	<h3 class="panel-title">Student Information</h3>
    	</header>
        <form  method="post" action="add_jobtracer.php?id=<?php echo $id; ?>" enctype="multipart/form-data" >
    <div class="panel-body">
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
            	<input value="<?=$row['s_ic']?>" class="form-control nric" name="s_ic" type="text" placeholder="e.g. 923052074239" required>
            </div> 
        
            <div class="form-group">
            	<label>Company Name</label>
            	<input value="<?=$row['company_name']?>" class="form-control" name="c_name" type="text" placeholder="" required>
            </div> 
        
            <div class="form-group">
            	<label>Company Address</label>
            	<input value="<?=$row['company_address']?>" class="form-control" name="c_address" type="text" placeholder="" required>
            </div>
            <!--<div class="form-group">
            	<label>Secondary School</label>
            	<input value="<?=$row['secondary_school']?>" class="form-control" name="c_school" type="text" placeholder="" required>
            </div> --> 
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
                    <input class="form-control" size="16" type="text" value="<?=$row['start_working_date']?>" placeholder="" required="">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" name="s_w_date" id="dtp_input<?=$row[0]?>" value="<?=$row['start_working_date']?>" />
            </div>
        
            <div class="form-group">
            	<label>Batch</label>
            	<input value="<?=$row['batch']?>" class="form-control" name="batch" type="text" placeholder="e.g. 1" required>
            </div> 
            
            <div class="form-group">
            	<label>Course</label>
                <select name="course" class="form-control" required>
                    <option value="">~ Select Course ~</option>
                    <?php 
                        $c_qry = "SELECT * FROM course";
                        $c_result = mysqli_query($conn, $c_qry);
                        while($c_row = mysqli_fetch_array($c_result)){
						
                    ?>
                    <option value="<?php echo $c_row['id'];?>"  <?php if($c_row['id'] == $row['c_id']){ echo "selected=\"selected\"";}?>><?=$c_row['course']?></option>
                <?php }?>
                </select>    
            </div>
              
        </div>
        
  </div>
  <div class="col-md-12">
			<button type="submit" name="update_jobtracer" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> update </button>
      </div>
    </div>
    </form>
       
	</div>
    
</div>
<?php require('footer.php'); ?>