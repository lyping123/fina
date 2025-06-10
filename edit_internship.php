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

$query="select * from internship where id='$id'";
$sttr=mysqli_query($conn,$query);
$row=mysqli_fetch_array($sttr);
?>
<div class="container">
<?php 
	if(isset($system_msg)){echo $system_msg;}
?>
	<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">INTERNSHIP EDIT FORM
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
  	<div class="panel panel-info">
    	<header class="panel-heading">
    	<h3 class="panel-title">Student Information</h3>
    	</header>
        <form  method="post" action="add_internship.php?id=<?php echo $id;?>" enctype="multipart/form-data" >
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
            	<label>Start Internship Date</label>
                <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtpp_input<?=$row[0]?>" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="<?=$row['start_internship']?>" placeholder="" required="required">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" name="si_date" id="dtpp_input<?=$row[0]?>" value="<?=$row['start_internship']?>" />
            </div>
            
            <div class="form-group">
            	<label>End Internship Date</label>
                <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtppp_input<?=$row[0]?>" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="<?=$row['end_internship']?>" placeholder="" required="required">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" name="ei_date" id="dtppp_input<?=$row[0]?>" value="<?=$row['end_internship']?>" />
            </div>
        </div>
        
        <div class="col-md-6">
        
            <div class="form-group">
            	<label>Elaun</label>
            	<input value="<?=$row['elaun']?>" class="form-control" name="elaun" type="text" placeholder="" required>
            </div>  
        
            <div class="form-group">
            	<label>Company Name</label>
            	<input value="<?=$row['company_name']?>" class="form-control" name="c_name" type="text" placeholder="" required>
            </div> 
        
            <div class="form-group">
            	<label>Company Address</label>
            	<input value="<?=$row['company_address']?>" class="form-control" name="c_address" type="text" placeholder="" required>
            </div> 
        
            <div class="form-group">
            	<label>Company Contact</label>
            	<input value="<?=$row['company_contact']?>" class="form-control" name="c_contact" type="text" placeholder="e.g. 0123456789" required>
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
                    <option value="<?=$c_row['id']?>" <?php if($c_row['id'] == $row['c_id']){ echo "selected=\"selected\"";}?>><?=$c_row['course']?></option>
                <?php }?>
                </select>    
            </div>
              
        </div>
  </div>
  <div class="col-md-12">
			<button type="submit" name="update_internship" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> update </button>
      </div>
    </div>
    </form>
       
	</div>
    
</div>
<?php require('footer.php'); ?>