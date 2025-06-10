<?php 
require('include/include.php');
require('header.php');
$system_msg='';
$course = '';
$course1 = '';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add Group.');
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully add Group.');	
}

if(isset($_SESSION['dp']) && $_SESSION['dp'] == 'Department Head'){
	$course .= " AND c_id = '".$_SESSION['course']."'";
	$course1 .= " AND id = '".$_SESSION['course']."'";
}else{
	$course = '';
	$course1 = '';
}
?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Group Form
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
        
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Group Information</h3>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="add_group.php" enctype="multipart/form-data">    
        <div class="col-md-5">
            <div class="form-group">
            <label>Group Name</label>
            <input type="text" class="form-control" name="gname" value="" required>
            </div>
            
            <div class="form-group">
            <label>PP</label>
            <select name="pp" class="form-control" required>
                <option value="">Choose</option>
                <?php
					$c_qry1 = "SELECT * FROM login WHERE level = 'pp' AND l_status = 'ACTIVE'".$course;
					$c_result1 = mysqli_query($conn,$c_qry1);
					while($c_row1 = mysqli_fetch_array($c_result1)){
				?>
                <option value="<?=$c_row1['id']?>"><?=$c_row1['l_name']?></option>
                <?php }?>
            </select>
            </div>
            
            <div class="form-group">
            <label>Course</label>
            <select name="course" class="form-control" required>
                <option value="">Choose</option>
                <?php
					$c_qry = "SELECT * FROM course WHERE status = 'ACTIVE'".$course1;
					$c_result = mysqli_query($conn,$c_qry);
					while($c_row = mysqli_fetch_array($c_result)){
				?>
                <option value="<?=$c_row['id']?>"><?=$c_row['course']?></option>
                <?php }?>
            </select>
            </div>
            
            <div class="form-group">
            <label>Level</label>
            <input type="text" class="form-control" name="level" value="" required>
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