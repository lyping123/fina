<?php 
include("include/include.php");
include("header.php");
//print_r($_POST);
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_update_success'){
	$system_msg .= systemMsg('alert-success','Success!','Leave successfully update & support/approve.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_update_fail'){
	$system_msg .= systemMsg('alert-danger','Fail!','Leave fail to update & support/approve.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_login_success'){
	$system_msg .= systemMsg('alert-success','Success!',"Welcome $_SESSION[name].");	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_send'){
	$system_msg .= systemMsg('alert-danger','Fail!','Email Send Fail.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_empty_pp'){
	$system_msg .= systemMsg('alert-danger','Fail!','Group no found, inform your teacher to slove the problem.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_leave_error'){
	$system_msg .= systemMsg('alert-danger','Fail!','No enough leave, please try again.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_reject_success'){
	$system_msg .= systemMsg('alert-success','Success!','Leave reject successfully');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_reject_fail'){
	$system_msg .= systemMsg('alert-danger','Fail!','Leave fail to reject.');	
}

$qry = "SELECT * FROM apply_leave_list AS al
        INNER JOIN student AS s ON s.id = al.s_id
        LEFT JOIN student_leave AS sl ON sl.s_id = s.id
        WHERE al.id = '".$_GET['id']."'";
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($result);


$qry1 = "SELECT *, SUM(a_days) AS total_apply FROM apply_leave_list WHERE s_id = '".$row[1]."' AND a_leave_type = 'Leave' AND year(STR_TO_DATE(a_from, '%d-%m-%Y')) = '".YEAR."' AND a_status = 'APPROVAL'";
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
                        <div> Available Leave : <?=$leave?></div>
                    </small>
                </h1>
                
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <form method="post" action="sl.php?action=approve&id=<?=$_GET['id']?>" enctype="multipart/form-data">
			<div class="row">
                <div class="panel panel-primary">
                    <div class="panel-heading">Student Leave Information</div>
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
                                        <option value="Leave" <?php if($row['a_leave_type'] == 'Leave'){ echo'selected';}?>>Leave</option>
                                        <option value="Medical" <?php if($row['a_leave_type'] == 'Medical'){ echo'selected';}?>>Medical</option>
                                        <option value="Emergency" <?php if($row['a_leave_type'] == 'Emergency'){ echo'selected';}?>>Emergency</option>
                                        <option value="Parental" <?php if($row['a_leave_type'] == 'Parental'){ echo'selected';}?>>Parental</option>
                                    </select>
                                </div> 

                                <div class="form-group">
                                    <label>How Many Days?</label>
                                    <select class="form-control" name="days" id="days" required="">
                                        <option value="">Choose</option>
                                        <?php
                                        for($i = 1 ; $i <= 31; $i++){
                                            ?><option value="<?=$i?>" <?php if($row['a_days'] == $i){ echo'selected';}?>><?=$i?></option><?php
                                        }
                                        ?>
                                    </select>
                                </div> 

                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="text" name="daterange" value="<?=$row['a_from'].' - '.$row['a_to']?>" class="form-control" required="">
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reason</label>
                                    <textarea class="form-control" name="reason" type="text" placeholder="" rows="5" required=""><?=$row['a_reason']?></textarea>
                                </div>  

                                <div class="form-group">
                                    <label>Remark</label>
                                    <textarea class="form-control" name="remark" type="text" placeholder="" rows="5"><?=$row['a_remark']?></textarea>
                                </div>  
                                <div class="form-group" id="divimg">
                                    <label>Attachment</label>
                                    <input id="img" class="form-control" name="img" type="file" min="1" value="<?=$row['a_photo']?>" placeholder="">
                                    <?php if(!empty($row['a_photo'])){?>
                                    <a href="<?=$row['a_photo']?>" target="_blank"><img src="<?=$row['a_photo']?>" style="height:  200px;"></a>
                                    <input type="hidden" name="photo" value="<?=$row['a_photo']?>">
                                    <?php }?>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <?php
                                    if($_SESSION['dp'] == 'Department Lecturer'){
                                        if($row['a_status'] == 'APPROVAL'){?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="button" name="submit" value="apply" class="btn btn-primary btn-lg" style="width: 100%;" onclick="location.href='studentapplyleavelist.php'"><span class="glyphicon glyphicon-arrow-left"></span>Back</button>
                                            </div>
                                        </div>
                                    <?php
                                        }else{?>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" name="submit" value="update" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon "></span>Update & Support</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="button" name="submit" value="apply" class="btn btn-danger btn-lg" style="width: 100%;" onclick="location.href='sl.php?action=reject&id=<?=$_GET['id']?>'"><span class="glyphicon glyphicon-remove-sign"></span>Reject</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="button" name="submit" value="apply" class="btn btn-primary btn-lg" style="width: 100%;" onclick="location.href='studentapplyleavelist.php'"><span class="glyphicon glyphicon-arrow-left"></span>Back</button>
                                        </div>
                                    </div>
                                    <?php }}else{?>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" name="submit" value="update" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon "></span>Update & Approve</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="button" name="submit" value="apply" class="btn btn-danger btn-lg" style="width: 100%;" onclick="location.href='sl.php?action=reject&id=<?=$_GET['id']?>'"><span class="glyphicon glyphicon-remove-sign"></span>Reject</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="button" name="submit" value="apply" class="btn btn-primary btn-lg" style="width: 100%;" onclick="location.href='studentapplyleavelist.php'"><span class="glyphicon glyphicon-arrow-left"></span>Back</button>
                                        </div>
                                    </div>
                                    <?php }?>


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
<!--<script>
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
</script>-->