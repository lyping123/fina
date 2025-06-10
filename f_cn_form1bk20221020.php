<?php
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully add receipt details.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add receipt details.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_success_del'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully delete receipt details.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_fail_del'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to delete receipt details.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_success_clear'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully clear all receipt details.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_fail_clear'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to clear all receipt details.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_cart_empty'){
	$system_msg .= systemMsg('alert-warning','Warning!','Cart is Empty!');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_save'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully Open Receipt.');	
}

if(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_success_add'){
	
}

$chk_qry = "SELECT c_desc FROM f_cn_cart";
$chk_result = mysqli_query($conn, $chk_qry);
	if (mysqli_num_rows($chk_result) > 0) { 
		$require = '';
	}
	else{
		
		$require = 'required="required"';
		
	}
?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
<?php
$qry_rcp = "SELECT * FROM f_cn";
$result_rcp = mysqli_query($conn, $qry_rcp);
$c_row = mysqli_num_rows($result_rcp);

$no = 10001;

$new_no = $no + $c_row;
?>
<form class="form-horizontal" method="post" action="f_cn1.php" enctype="multipart/form-data"> 
		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                <p>Credit Note</p><!--<small><p class="pull-right" style="margin-top: -20px;">No: <?=$new_no?></p></small>-->
                </h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6">
        
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Receipt Information</h3>
    </header>
    <div class="panel-body">
           <div class="col-md-12">
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Description</label>
                    <!-- <input type="text" class="form-control" name="desc" value="" required> -->
                    <textarea name='desc' rows="3" class="form-control"  required ></textarea>


                    <!--<select name="desc" id="desc" class="form-control" <?=$require?>>
                        <option value="Tuition Fee" >Tuition Fee</option>
                        <option value="Hostel Fee" >Hostel Fee</option>
                        <option value="Exam Fee" >Exam Fee</option>
                        <option value="Insurance" >Insurance</option>
                        <option value="Enrollment Fee" >Enrollment Fee</option>
                        <option value="JPK" >JPK</option>
                        <option value="Security Deposit">Security Deposit (Hostel)</option>
                    </select>-->
                </div>
                <div class="form-group">
                    <label>Amount</label>
                    <input type="text" class="form-control" name="amount" value="" required>
                </div>
                
                  <br />
                <div class="form-group " style="text-align: center">
                    <button type="submit" class="btn btn-primary btn-block" name="submit" value="add"><i class=""></i> Add </button>
                </div>
                
            </div>
            
            
     
    </div>  
</div>
			</div>
            
            <div class="col-lg-6">

                <div class="form-group">
					<a class="btn btn-danger pull-right" href="f_cn1.php?action=clear" onclick="return confirm('Confirm to clear all record?')"> Clear All </a><br />
                </div>
<style>
#table.table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 15px;
}
</style>

<div style="height: 250px; overflow: auto;" id="table">  
<table style="width:100%">
  <tr>
    <th>Description</th>
    <th>Amount</th>
    <th>Action</th>
  </tr>
<?php

$qry_cart = "SELECT * FROM f_cn_cart WHERE u_id = '".$_SESSION['id']."'";
$result_cart = mysqli_query($conn, $qry_cart);
while($row_cart = mysqli_fetch_array($result_cart)){
?>
  <tr>
    <td><?=nl2br($row_cart['c_desc'])?></td>
    <td><?=$row_cart['c_amount']?></td>
    <td><a class="btn btn-danger" href="f_cn1.php?action=delete&id=<?=$row_cart['id']?>" onclick="return confirm('Confirm to Delete this Record?')"> Delete </a></td>
  </tr>
<?php }?>
</table>
</div>
<br />

			</div>
        </div>
        
<hr />
</form>
<form class="form-horizontal" method="post" action="f_cn1.php" enctype="multipart/form-data"> 
        <div class="row">
            <div class="col-lg-6">
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Student Information</h3>
    </header>
    <div class="panel-body">
           <div class="col-md-12">
            <div class="form-group">
                <label>Student Name</label>
                <input style="width:523px;" id="my-input1" class="form-control typeahead" name="name" type="text" value="" onfocusout="showHint(this.value);" required>
            </div>
            <div id="txtHint">
            <div class="form-group" >
                <label>Student IC</label>
                <input class="form-control" name="ic" type="text" value=""  required>
            </div>
            </div>
            <div class="form-group">
                <label>Original Bill No.</label>
                <input class="form-control" name="org_bill_no" type="text" value="" required>
            </div>
            </div>
        
            <div class="col-md-12">
                <div class="form-group">
                    <label>Receipt Date</label>
                    <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="" required>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <input type="hidden" name="date" id="dtp_input2" value="" />
                </div>
            </div>
            
            
     
    </div>  
</div>
            </div>
        </div>

        <div class="row">
        	<center><button type="submit" class="btn btn-primary" name="submit" value="save"><i class=""></i> Save </button>
          
              <!--<a class="btn btn-primary" href="print_feeRefund.php"> Print Fee Refund Letter </a>-->
             
            </center>
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
		/*document.getElementById('c_loan').disabled = false;*/
		document.getElementById('hostel').disabled = true;
		document.getElementById('internal').disabled = true;
		document.getElementById('debtor').disabled = true;
	} else {
		/*document.getElementById('c_loan').disabled = true;
		document.getElementById('c_loan').checked = false;*/
		document.getElementById('hostel').disabled = false;
		document.getElementById('internal').disabled = false;
		document.getElementById('debtor').disabled = false;
	}
}

function validate3(){
	if(document.getElementById('hostel').checked) {
		document.getElementById('tuition').disabled = true;
		document.getElementById('internal').disabled = true;
		document.getElementById('debtor').disabled = true;
	} else {
		document.getElementById('tuition').disabled = false;
		document.getElementById('internal').disabled = false;
		document.getElementById('debtor').disabled = false;
	}
}

function validate4(){
	if(document.getElementById('internal').checked) {
		document.getElementById('hostel').disabled = true;
		document.getElementById('tuition').disabled = true;
		document.getElementById('debtor').disabled = true;
	} else {
		document.getElementById('hostel').disabled = false;
		document.getElementById('tuition').disabled = false;
		document.getElementById('debtor').disabled = false;
	}
}

function validate5(){
	if(document.getElementById('debtor').checked) {
		document.getElementById('hostel').disabled = true;
		document.getElementById('tuition').disabled = true;
		document.getElementById('internal').disabled = true;
	} else {
		document.getElementById('hostel').disabled = false;
		document.getElementById('tuition').disabled = false;
		document.getElementById('internal').disabled = false;
	}
}
</script>
<?php require('footer.php');?>