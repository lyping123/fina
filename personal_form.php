<?php
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully add receipt.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add receipt.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_success_del'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully delete receipt.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_fail_del'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to delete receipt.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_success_clear'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully clear all receipt.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_fail_clear'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to clear all receipt.');	
}
?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
<?php
$qry_rcp = "SELECT * FROM student WHERE id='".$_GET['id']."'";
$result_rcp = mysqli_query($conn, $qry_rcp);
$c_row = mysqli_num_rows($result_rcp);
$row = mysqli_fetch_array($result_rcp);
$no = 10001;
$new_no = $no + $c_row;
?>

		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                <p>Synergy College: Student Personal File</p><small><p class="pull-right" style="margin-top: -20px;">No: <?=$new_no?></p></small>
                </h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
        
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Personal File</h3>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="print_personal.php" enctype="multipart/form-data">    
            <div class="col-md-12">
                <div class="form-group">
                    <label>Student Name </label>
                    <input type="text" class="form-control" name="name" value="<?=$row['s_name']?>"  required>
                </div>
                <div class="form-group">
                    <label>Student ID No </label>
                    <input type="text" class="form-control" name="sid" value="<?=$row['s_id']?>" required>
                </div>
                <div class="form-group">
                    <label>Student IC </label>
                    <input type="text" class="form-control" name="ic" value="<?=$row['ic']?>" required>
                </div>
                <div class="form-group">
                <label>Course</label>
               <select name="course" class="form-control" required>
                <option value="Accounting" <?php if($row['course'] == 'Accounting'){echo "selected=\"selected\"";}?>>Accounting</option>
                <option value="Electronic" <?php if($row['course'] == 'Electronic'){echo "selected=\"selected\"";}?>>Electronic</option>
                <option value="Multimedia" <?php if($row['course'] == 'Multimedia'){echo "selected=\"selected\"";}?>>Multimedia</option>
                <option value="Networking" <?php if($row['course'] == 'Networking'){echo "selected=\"selected\"";}?>>Networking</option>
                <option value="Programming" <?php if($row['course'] == 'Programming'){echo "selected=\"selected\"";}?>>Programming</option>
            </select>
                </div>
                <div class="form-group">
            <label>Date Join</label>
<div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">
<input class="form-control" size="16" type="text" value="<?=$row['date_join']?>" required="required">
<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
</div>
<input type="hidden" name="join_date" id="dtp_input3" value="<?=$row['date_join']?>" /><br/>
            </div>
                <br />
                
            </div>
        </form>
    </div>  
</div>
			</div>
            
            
        </div>
        
<hr />

        
        <div class="row">
        	<center><a class="btn btn-primary " href="print_personal.php?&id=<?=$row_rcp['id']?>" target="_blank"><i class="icon-print"></i> Print Personal File</a></center>
            <input type="hidden"  name="r_no" value="<?=$new_no?>"/>
        </form>
        </div>
        
        
<script>
function validate(){
	if(document.getElementById('cheque').checked) {
		document.getElementById('c_no').disabled = false;
		document.getElementById("c_no").required = true;
		document.getElementById('b_date').disabled = false;
		document.getElementById("b_date").required = true;
		document.getElementById('banker').disabled = false;
		document.getElementById("banker").required = true;
		document.getElementById('bankin').disabled = true;
		$("#r_date span").css({ "pointer-events": "auto" });
		$("#s_date span").css({ "pointer-events": "auto" });
	} else {
		document.getElementById('c_no').disabled = true;
		document.getElementById("c_no").required = false;
		document.getElementById('b_date').disabled = true;
		document.getElementById("b_date").required = false;
		document.getElementById('banker').disabled = true;
		document.getElementById("banker").required = false;
		document.getElementById('bankin').disabled = false;
		$("#r_date span").css({ "pointer-events": "none" });
		$("#s_date span").css({ "pointer-events": "none" });
	}
}

function validate1(){
	if(document.getElementById('bankin').checked) {
		document.getElementById('bank_in_date').disabled = false;
		document.getElementById("bank_in_date").required = true;
		document.getElementById('bankin_banker').disabled = false;
		document.getElementById("bankin_banker").required = true;
		document.getElementById('cheque').disabled = true;
		$("#r_bankin_date span").css({ "pointer-events": "auto" });
		$("#s_bankin_date span").css({ "pointer-events": "auto" });
	} else {
		document.getElementById('bank_in_date').disabled = true;
		document.getElementById("bank_in_date").required = false;
		document.getElementById('bankin_banker').disabled = true;
		document.getElementById("bankin_banker").required = false;
		document.getElementById('cheque').disabled = false;
		$("#r_bankin_date span").css({ "pointer-events": "none" });
		$("#s_bankin_date span").css({ "pointer-events": "none" });
	}
}

function validate2(){
	if(document.getElementById('tuition').checked) {
		document.getElementById('c_loan').disabled = false;
	} else {
		document.getElementById('c_loan').disabled = true;
		document.getElementById('c_loan').checked = false;
	}
}
</script>
<?php require('footer.php');?>