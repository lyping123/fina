<?php 
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add PP.');
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully add PP.');	
}
?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add PP Form
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
        
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">PP Information</h3>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="add_pp.php" enctype="multipart/form-data">    
        <div class="col-md-5">
            <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username" value="" required>
            </div>
            <div class="form-group">
            <label>Password</label>
            <input type="text" class="form-control" name="password" value="" required>
            </div>
            <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="" required>
            </div>
            
            <div class="form-group">
            <label>Course</label>
            <select name="course" class="form-control" required>
                <option value="">Choose</option>
                <?php
					$c_qry = "SELECT * FROM course WHERE status = 'ACTIVE'";
					$c_result = mysqli_query($conn,$c_qry);
					while($c_row = mysqli_fetch_array($c_result)){
				?>
                <option value="<?=$c_row['id']?>"><?=$c_row['course']?></option>
                <?php }?>
            </select>
            </div>
            
            <div class="form-group">
            <label>Department Position</label>
            <select name="dp" class="form-control" required>
                <option value="">Choose</option>
                <option value="Department Head">Department Head</option>
                <option value="Department Lecturer">Department Lecturer</option>
            </select>
            </div>
            
        
        <div class="col-md-12">
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="submit" value="save"><i class=""></i> Save </button>
            </div>
        </div>
        </form>
     
	</div>
</div>
        </div>
        <!-- /.row -->
<?php require('footer.php');?>
<script>
function validate(){
	if(document.getElementById('hostel').checked) {
		document.getElementById('h_fee').disabled = false;
		document.getElementById("h_fee").required = true;
		document.getElementById('h_cost').disabled = false;
		document.getElementById("h_cost").required = true;
		document.getElementById('h_month').disabled = false;
		document.getElementById("h_month").required = true;
	} else {
		document.getElementById('h_fee').disabled = true;
		document.getElementById("h_fee").required = false;
		document.getElementById('h_cost').disabled = true;
		document.getElementById("h_cost").required = false;
		document.getElementById('h_month').disabled = true;
		document.getElementById("h_month").required = false;
	}
}
</script>