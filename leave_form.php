<?php 
include("include/sinclude.php");
include("header_student.php");
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
                    <small class="pull-right" >
                        <div> Available Leave : <?=$leave?></div>
                    </small>
                </h1>
                
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <form method="post" action="apply_leave.php" enctype="multipart/form-data">
			<div class="row">
                <div class="panel panel-primary">
                    <div class="panel-heading">Enter Leave Information</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input value="<?=$row['s_name']?>" class="form-control" name="name" type="text" placeholder="" readonly="">
                                </div> 

                                <div class="form-group">
                                    <label>IC</label>
                                    <input value="<?=$row['ic']?>" class="form-control" name="ic" type="text" placeholder="" readonly="">
                                </div> 

                                <div class="form-group">
                                    <label>Leave Type</label>
                                    <select class="form-control" name="leave_type" id="leave_type" required="">
                                        <option value="">Choose</option>
                                        <option value="Leave" id="">Leave</option>
                                        <option value="Medical" id="">Medical</option>
                                        <option value="Emergency" id="">Emergency</option>
                                        <option value="Other" id="">Other</option>
                                        <!--<option value="Parental" id="">Parental</option>-->
                                    </select>
                                </div> 

                                <div class="form-group">
                                    <label>How Many Days?</label>
                                    <select class="form-control" name="days" id="days" required="">
                                        <option value="">Choose</option>
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
	$(document).ready(function(){
	  $('#leave_type').on('change', function() {
		var lt =  $('#leave_type').val();
		var id =  <?=$_SESSION['id']?>;
			//use ajax to run the check  
			$.post("leave.php", { value: lt, id: id},  
				function(result){  
					$( "#days" ).html(result);
				});  
		  
			if(lt == 'Medical' || lt == 'Parental'){
				$("#img").prop('required',true);
			}else{
				$("#img").prop('required',false);
			}
	  });
	});
</script>