<?php 
include("include/include.php");
include("header.php");
//print_r($_POST);
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Apply leave successfully.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail To Apply Leave.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_login_success'){
	$system_msg .= systemMsg('alert-success','Success!',"Welcome $_SESSION[name].");	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_send'){
	$system_msg .= systemMsg('alert-danger','Fail!','Email Send Fail.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_empty_pp'){
	$system_msg .= systemMsg('alert-danger','Fail!','Group no found, inform your teacher to slove the problem.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_leave_error'){
	$system_msg .= systemMsg('alert-danger','Fail!','No enough leave, please try again.');	
}

$qry = "SELECT * FROM student AS u 
		LEFT JOIN student_leave AS sl ON sl.s_id = u.id
		WHERE u.id = '".$_SESSION['id']."'";
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($result);


$qry1 = "SELECT *, SUM(a_days) AS total_apply FROM apply_leave_list WHERE s_id = '".$_SESSION['id']."' AND a_leave_type = 'Leave' AND year(STR_TO_DATE(a_from, '%d-%m-%Y')) = '".YEAR."' AND a_status = 'APPROVAL'";
$result1 = mysqli_query($conn,$qry1);
$row1 = mysqli_fetch_array($result1);

$leave = $row['leave'] - $row1['total_apply'];
?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>

        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Apply Leave Form
                    <small class="pull-right" style="">
                        <div> Available Leave : <p id="annual"></p></div>
                    </small>
                </h1>
                
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <form method="post" action="sl.php" enctype="multipart/form-data">
			<div class="row">
                <div class="panel panel-primary">
                    <div class="panel-heading">Enter Leave Information</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
								<label>Student Name</label><br>
								<select class="selectpicker" name="name" id="name" data-live-search="true" required>
								<option value="">Choose</option>
								<?php
								$s_qty = "SELECT id,s_name FROM student WHERE s_status <> 'DELETE'";	
								$s_result = mysqli_query($conn, $s_qty);
								while($s_row = mysqli_fetch_array($s_result)){
								?>
								<option value="<?=$s_row['id']?>"><?=$s_row['s_name']?></option>
								<?php
								}
								?>
								</select>
                                </div> 

                                <div class="form-group">
                                    <label>IC</label>
                                    <input value="" class="form-control" name="ic" id="ic" type="text" placeholder="">
                                </div> 

                                <div class="form-group">
                                    <label>Leave Type</label>
                                    <select class="form-control" name="leave_type" id="leave_type" required="">
                                        <option value="">Choose</option>
                                        <option value="Leave" id="">Leave</option>
                                        <option value="Medical" id="">Medical</option>
                                        <option value="Emergency" id="">Emergency</option>
                                        <!--<option value="Parental" id="">Parental</option>-->
                                    </select>
                                </div> 

                                <div class="form-group">
                                    <label>How Many Days?</label>
                                    <select class="form-control" name="days" id="days" required="">
                                        <option value="">Choose</option>
                                        <?php
                                        for($i = 1 ; $i <= 31; $i++){
                                            ?><option value="<?=$i?>"><?=$i?></option><?php
                                        }
                                        ?>
                                    </select>
                                </div> 

                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="text" name="daterange" value="" class="form-control" required="">
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reason</label>
                                    <textarea class="form-control" name="reason" type="text" placeholder="" rows="5" required=""></textarea>
                                </div>  

                                <div class="form-group">
                                    <label>Remark</label>
                                    <textarea class="form-control" name="remark" type="text" placeholder="" rows="5"></textarea>
                                </div>  
                                <div class="form-group" id="divimg">
                                    <label>Attachment</label>
                                    <input id="img" class="form-control" name="img" type="file" min="1" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" name="submit" value="apply" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp;Apply </button>
                            </div>

                        </div>
                        <!-- /.col-lg-6 (nested) --> 
                    </div>
                    <!-- /.row (nested) -->
                </div>
			</div>        
        </form>
        
<?php 
require ('footer.php');
?>
<script>
	$('#name').on('change', function(){
        var selected = $(this).find("option:selected").val();
		//alert(selected);
			//use ajax to run the check  
		$.post("student_leave.php", { id: selected },  
			function(result){  
                var obj = JSON.parse(result);
				$("#ic").val(obj.ic);
				$("#annual").text(obj.annual);
			}); 
	});
</script>
<script>
   
</script>