<?php 
require('include/include.php');
require('header.php');
$system_msg='';
$course = '';
$course1 = '';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_edit'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to edit Verification.');
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_edit'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully edit Verification.');	
}

if(isset($_SESSION['level']) && $_SESSION['level'] == 'admin' || $_SESSION['level'] == 'superadmin'){
	$course .= "";
}else{
	$course .= " AND c_id = '".$_SESSION['course']."'";
}

$qry = "SELECT * FROM verification AS v
		INNER JOIN course AS c ON c.id = v.department
		WHERE v.v_status = 'ACTIVE' AND v.id = '".$_GET['id']."'".$course;
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($result);
?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Student Verification
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
        
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Verification Information</h3>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="verification.php?action=edit&id=<?=$row[0]?>" enctype="multipart/form-data">    
        <div class="col-md-5">
            <div class="form-group">
            <label>Student Name</label><br>
			<select class="selectpicker" name="name" id="name" data-live-search="true" required>
			<option value="">Choose</option>
			<?php
			$s_qty = "SELECT id,s_name FROM student WHERE s_status = 'GRADUATE'";	
			$s_result = mysqli_query($conn, $s_qty);
			while($s_row = mysqli_fetch_array($s_result)){
			?>
			<option value="<?=$s_row['id']?>"><?=$s_row['s_name']?></option>
			<?php
			}
			?>
			</select><br>
			<p>Only the Graduate student in system can be select.</p>
			<p>If the Graduate student is not in system, please tick here.<input type="checkbox" id="other" <?php if(!is_numeric($row['s_name'])){ echo 'checked';}?>></p>
            </div>
			
            <div class="form-group" id="divother" style="display:  none;">
            <label>Student Name</label>
            <input type="text" class="form-control" id="name1" name="name" value="<?=$row['s_name']?>" disabled>
            </div>
			
            <div class="form-group">
            <label>Student IC</label>
            <input type="text" class="form-control" id="ic" name="ic" value="<?=$row['s_ic']?>" pattern="^\d{12}$" readonly required>e.g 991010071010
            </div>
			
			<div class="form-group">
            <label>Start Date</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="sd" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="<?=$row['s_date']?>" required >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="sd" id="sd" value="<?=$row['s_date']?>" />
            </div>
			
			<div class="form-group">
            <label>End Date</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="ed" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="<?=$row['e_date']?>" required >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="ed" id="ed" value="<?=$row['e_date']?>" />
            </div>
		</div>
		<div class="col-md-2"></div>
        <div class="col-md-5">
            
            <div class="form-group">
            <label>Department</label>
            <select name="course" class="form-control" id="course" required>
                <option value="">Choose</option>
                <?php
					$c_qry = "SELECT * FROM course WHERE status = 'ACTIVE'".$course1;
					$c_result = mysqli_query($conn,$c_qry);
					while($c_row = mysqli_fetch_array($c_result)){
				?>
                <option value="<?=$c_row['id']?>" <?php if($row['department'] == $c_row['id']){ echo 'selected';}?>><?=$c_row['course']?></option>
                <?php }?>
            </select>
            </div>
			
            <div class="form-group">
            <label>Course Name</label>
            <input type="text" class="form-control" name="cname" value="<?=$row['course_name']?>" required>
            </div>
			
            <!--<div class="form-group">
            <label>CGPA Semester 1</label>
            <input type="text" class="form-control" name="s1" value="">
            </div>
			
            <div class="form-group">
            <label>CGPA Semester 2</label>
            <input type="text" class="form-control" name="s2" value="">
            </div>
			
            <div class="form-group">
            <label>CGPA Semester 3</label>
            <input type="text" class="form-control" name="s3" value="">
            </div>
			
            <div class="form-group">
            <label>CGPA Semester 4</label>
            <input type="text" class="form-control" name="s4" value="">
            </div>
			
            <div class="form-group">
            <label>CGPA Semester 5</label>
            <input type="text" class="form-control" name="s5" value="">
            </div>-->
			
            <div class="form-group">
            <label>CGPA</label>
            <input type="text" class="form-control" name="s6" value="<?=$row['s5']?>">
            </div>
     
		</div>
        
        <div class="col-md-12">
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="submit" value="edit"><i class=""></i> Save </button>
            </div>
        </div>
        </form>
</div>
        </div>
        <!-- /.row -->
<?php require('footer.php');?>
<script>
	
$(document).ready(function () {
	if ($('#other').is(':checked')) {
		$("#name").prop("disabled", true);
		$("#name1").prop("disabled", false);
		$("#ic").prop("readonly", false); 
		$("#divother").css('display','block')
		$("#name").prop("required", false); 
		$("#name1").prop("required", true); 
    }else{
		$("#name").prop("disabled", false);
		$("#name1").prop("disabled", true); 
		$("#ic").prop("readonly", true); 
		$("#divother").css('display','none')
		$("#name").prop("required", true); 
		$("#name1").prop("required", false); 
		
		$('.selectpicker').selectpicker('refresh');
		$('#name').selectpicker('val', '<?=$row['s_name']?>');
	}
});
	
$('#name').on('change', function(){
	var selected = $(this).find("option:selected").val();
	//alert(selected);
		//use ajax to run the check  
	$.post("student_ic.php", { id: selected },  
		function(result){  
			$("#ic").val(result);
		});  
});
	
$('#other').change(function() {
	if(this.checked) {
		$("#name").prop("disabled", true);
		$("#name1").prop("disabled", false);
		$("#ic").prop("readonly", false); 
		$("#divother").css('display','block')
		$("#name").prop("required", false); 
		$("#name1").prop("required", true); 
		$("#ic").val(''); 
		$("#name1").val(''); 
    }else{
		$("#name").prop("disabled", false);
		$("#name1").prop("disabled", true); 
		$("#ic").prop("readonly", true); 
		$("#divother").css('display','none')
		$("#name").prop("required", true); 
		$("#name1").prop("required", false); 
		$("#ic").val(''); 
		$("#name1").val(''); 
	}
	$('.selectpicker').selectpicker('refresh');
});
</script>