<?php 
require('include/include.php');
require('header.php');
$system_msg='';
$course = '';
$course1 = '';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_edit'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to Edit Group.');
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_edit'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully Edit Group.');	
}

if(isset($_SESSION['dp']) && $_SESSION['dp'] == 'Department Head'){
	$course .= " AND c_id = '".$_SESSION['course']."'";
	$course1 .= " AND id = '".$_SESSION['course']."'";
}else{
	$course = '';
	$course1 = '';
}

$qry = "SELECT * FROM student_group WHERE g_status = 'ACTIVE' AND id = '".$_GET['id']."'";
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($result);
?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Group
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
        <form class="form-horizontal" method="post" action="add_group.php?action=edit&id=<?=$row[0]?>" enctype="multipart/form-data">    
        <div class="col-md-5">
            <div class="form-group">
            <label>Group Name</label>
            <input type="text" class="form-control" name="gname" value="<?=$row['g_name']?>" required>
            </div>
			
			<div class="form-group">
            <label>JPK Start Date</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="sd" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="<?=$row['start_date']?>" required >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="sd" id="sd" value="<?=$row['start_date']?>" />
            </div>
			
			<div class="form-group">
            <label>JPK End Date</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="ed" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="<?=$row['end_date']?>" required >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="ed" id="ed" value="<?=$row['end_date']?>" />
            </div>
            
            <div class="form-group">
            <label>Level</label>
            <select name="level" class="form-control" required>
                <option value="">Choose</option>
                <option value="2" <?php if($row['g_level'] == '2'){ echo 'selected';}?>>2</option>
                <option value="3" <?php if($row['g_level'] == '3'){ echo 'selected';}?>>3</option>
                <option value="4" <?php if($row['g_level'] == '4'){ echo 'selected';}?>>4</option>
                <option value="Single Tier" <?php if($row['g_level'] == 'Single Tier'){ echo 'selected';}?>>Single Tier</option>
            </select>
            </div>
		</div>
		<div class="col-md-2"></div>
        <div class="col-md-5">
            
            <div class="form-group">
            <label>Course</label>
            <select name="course" class="form-control" id="course" required>
                <option value="">Choose</option>
                <?php
					$c_qry = "SELECT * FROM course WHERE status = 'ACTIVE'".$course1;
					$c_result = mysqli_query($conn,$c_qry);
					while($c_row = mysqli_fetch_array($c_result)){
				?>
                <option value="<?=$c_row['id']?>" <?php if($row['c_id'] == $c_row['id']){ echo 'selected';}?>><?=$c_row['course']?></option>
                <?php }?>
            </select>
            </div>
			
            <div class="form-group">
            <label>JPK PP</label><br>
            <select class="selectpicker" name="jpkpp" id="jpkpp" data-live-search="true" required>
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
            <label>College PP</label><br>
            <select class="selectpicker" name="pp" id="pp" data-live-search="true" required>
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
     
		</div>
        
        <div class="col-md-12">
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="submit" value="update"><i class=""></i> Save </button>
            </div>
        </div>
        </form>
</div>
        </div>
        <!-- /.row -->
<?php require('footer.php');?>
<script>
$(document).ready(function () {
    $("#course").change(function () {
		$("#jpkpp").empty();
		$("#pp").empty();
		$("#jpkpp").append('<option value="">Choose</option>');
		$("#pp").append('<option value="">Choose</option>');
        var val = $(this).val();
        $.post("pp.php", { value: val },  
            function(result){  
        		$("#jpkpp").append(result);
        		$("#pp").append(result);
				$('.selectpicker').selectpicker('refresh');
            }); 
    });
});
$(document).ready(function () {
	$("#jpkpp").empty();
	$("#pp").empty();
	$("#jpkpp").append('<option value="">Choose</option>');
	$("#pp").append('<option value="">Choose</option>');
	var val = $("#course").val();
	$.post("pp.php", { value: val },  
		function(result){  
			$("#jpkpp").append(result);
			$("#pp").append(result);
			$('.selectpicker').selectpicker('refresh');
			$('#jpkpp').selectpicker('val', <?=$row['jpk_pp_id']?>);
			$('#pp').selectpicker('val', <?=$row['p_id']?>);
		});
});
</script>