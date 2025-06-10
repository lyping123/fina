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

$qry = "SELECT * FROM f_receipt WHERE r_status = 'ACTIVE' AND id = '".$_GET['id']."'";
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($result);

$chk_qry = "SELECT c_desc FROM f_cart";
$chk_result = mysqli_query($conn, $chk_qry);
	if (mysqli_num_rows($chk_result) > 0) { 
		$require = '';
	}else{
		$require = 'required="required"';
	}
?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
<?php
$qry_rcp = "SELECT * FROM f_receipt";
$result_rcp = mysqli_query($conn, $qry_rcp);
$c_row = mysqli_num_rows($result_rcp);

$no = 10001;
$new_no = $no + $c_row;
?>
<form class="form-horizontal" method="post" action="f_rp_detail2.php?id=<?=$row['id']?>" enctype="multipart/form-data"> 
		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                <p>Receipt Form</p><!--<small><p class="pull-right" style="margin-top: -20px;">No: <?=$new_no?></p></small>-->
                </h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-5">
        
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
                    <input type="text" class="form-control" name="desc" value="" required>
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
            
            <div class="col-lg-7">

                <!--<div class="form-group">
					<a class="btn btn-danger pull-right" href="f_receipt2.php?action=clear" onclick="return confirm('Confirm to clear all record?')"> Clear All </a><br />
                </div>-->
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
$qry_cart = "SELECT * FROM f_receipt_detail WHERE r_id = '".$_GET['id']."'";
$result_cart = mysqli_query($conn, $qry_cart);
while($row_cart = mysqli_fetch_array($result_cart)){
?>
  <tr>
    <td><?=$row_cart['rp_desc']?></td>
    <td><?=$row_cart['rp_amount']?></td>
    <td><a class="btn btn-danger" href="f_rp_detail2.php?action=delete&id=<?=$row_cart['id']?>&r_id=<?=$row_cart['r_id']?>" onclick="return confirm('Confirm to Delete this Record?')"> Delete </a></td>
  </tr>
<?php }?>
</table>
</div>
<br />

			</div>
        </div>
        
<hr />
</form>
<form class="form-horizontal" method="post" action="f_receipt.php" enctype="multipart/form-data"> 
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
                <div id="basic-example">
                    <input class="form-control" name="name" type="text" value="<?=$row['s_name']?>" style="width:523px;" readonly>
                    <!--<input id="my-input1" class="form-control typeahead" name="name" type="text" value="<?=$row['s_name']?>" style="width:523px;" onfocusout="showHint(this.value);" required>-->
                </div>
            </div>
                <div class="form-group">
                    <label>NRIC</label>
                    <input type="text" class="form-control" name="ic" value="<?=$row['s_ic']?>" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Receipt Date</label>
                    <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="<?=$row['r_date']?>" readonly>
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
<hr />

        <div class="row">
            <div class="col-lg-6">

<!--<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Student Information</h3>
    </header>
    <div class="panel-body">
        
            
    </div>  
</div>
-->  
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Debto PTPKr</h3>
    </header>
    <div class="panel-body">  
            <div class="col-md-12">
                <div class="form-group">
					<input type="checkbox" id="debtor_ptpk" name="debtor_ptpk" value="debtor_ptpk" onclick="validate6()" <?php if($row['debtor_ptpk'] == 'YES'){ echo 'checked'; }?> disabled> Debtor PTPK
                </div>
            </div>
    </div>  
</div>
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Debtor</h3>
    </header>
    <div class="panel-body">  
            <div class="col-md-12">
                <div class="form-group">
					<input type="checkbox" id="debtor" name="debtor" value="debtor" onclick="validate5()" <?php if($row['debtor'] == 'YES'){ echo 'checked'; }?> disabled> Debtor
                </div>
            </div>
    </div>  
</div>
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Internal Exam Fee</h3>
    </header>
    <div class="panel-body">  
            <div class="col-md-12">
                <div class="form-group">
					<input type="checkbox" id="internal" name="internal" value="internal" onclick="validate4()"  <?php if($row['internal_exam_fee'] == 'YES'){ echo 'checked'; }?> disabled> Deduct From Internal Exam Fee
                </div>
            </div>
    </div>  
</div>
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Hostel Fee</h3>
    </header>
    <div class="panel-body">  
            <div class="col-md-12">
                <div class="form-group">
					<input type="checkbox" id="hostel" name="hostel" value="hostel" onclick="validate3()"  <?php if($row['hostel_fee'] == 'YES'){ echo 'checked'; }?> disabled> Deduct From Hostel Fee
                </div>
            </div>
    </div>  
</div>
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Tuition Fee</h3>
    </header>
    <div class="panel-body">  
            <div class="col-md-12">
                <div class="form-group">
					<input type="checkbox" id="tuition" name="tuition" value="tuition" onclick="validate2()"  <?php if($row['tuition_fee'] == 'YES'){ echo 'checked'; }?> disabled> Deduct From Tuition Fee
                </div>
            </div>
    </div>  
</div>

<!--<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">PTPK</h3>
    </header>
    <div class="panel-body">  
            <div class="col-md-12">
                <div class="form-group">
					<input type="checkbox" id="c_loan" name="c_loan" value="loan" disabled="disabled"> Loan from PTPK
                </div>
            </div>
    </div>  
</div>-->
            </div>
            
            <div class="col-lg-6">
<?php
	$bc_qry = "SELECT * FROM f_b_c WHERE r_id = '".$_GET['id']."'";
	$bc_result = mysqli_query($conn,$bc_qry);
	$bc_row = mysqli_fetch_array($bc_result);
	$bc_rows = mysqli_num_rows($bc_result);
?>
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title"><input type="checkbox" id="bankin" name="bankin" value="bankin" onclick="validate1()" <?php if($bc_row['cheque_no'] == 'BANKIN'){ echo 'checked'; }?> disabled> Bank In</h3>
    </header>
    <div class="panel-body"> 
            <div class="col-md-12">
                <div class="form-group">
                <label>Banker</label>
                <select name="bankin_banker" class="form-control" id="bankin_banker" disabled="disabled">
                    <option value="">Select The Bank</option>
                    <option value="Affin Bank Berhad" <?php if($bc_row['cheque_no'] == 'BANKIN' && $bc_row['banker'] == 'Affin Bank Berhad'){ echo "selected"; }?>>Affin Bank Berhad</option>
                    <option value="Alliance Bank" <?php if($bc_row['cheque_no'] == 'BANKIN' && $bc_row['banker'] == 'Alliance Bank'){ echo "selected"; }?>>Alliance Bank</option>
                    <option value="AmBank Berhad" <?php if($bc_row['cheque_no'] == 'BANKIN' && $bc_row['banker'] == 'AmBank Berhad'){ echo "selected"; }?>>AmBank Berhad</option>
                    <option value="CIMB Bank Berhad" <?php if($bc_row['cheque_no'] == 'BANKIN' && $bc_row['banker'] == 'CIMB Bank Berhad'){ echo "selected"; }?>>CIMB Bank Berhad</option>
                    <option value="Citibank Berhad" <?php if($bc_row['cheque_no'] == 'BANKIN' && $bc_row['banker'] == 'Citibank Berhad'){ echo "selected"; }?>>Citibank Berhad</option>
                    <option value="Hong Leong Bank Berhad" <?php if($bc_row['cheque_no'] == 'BANKIN' && $bc_row['banker'] == 'Hong Leong Bank Berhad'){ echo "selected"; }?>>Hong Leong Bank Berhad</option>
                    <option value="HSBC Bank Malaysia Berhad" <?php if($bc_row['cheque_no'] == 'BANKIN' && $bc_row['banker'] == 'HSBC Bank Malaysia Berhad'){ echo "selected"; }?>>HSBC Bank Malaysia Berhad</option>
                    <option value="Maybank" <?php if($bc_row['cheque_no'] == 'BANKIN' && $bc_row['banker'] == 'Maybank'){ echo "selected"; }?>>Maybank</option>
                    <option value="OCBC Bank Malaysia Berhad" <?php if($bc_row['cheque_no'] == 'BANKIN' && $bc_row['banker'] == 'OCBC Bank Malaysia Berhad'){ echo "selected"; }?>>OCBC Bank Malaysia Berhad</option>
                    <option value="Public Bank Berhad" <?php if($bc_row['cheque_no'] == 'BANKIN' && $bc_row['banker'] == 'Public Bank Berhad'){ echo "selected"; }?>>Public Bank Berhad</option>
                    <option value="RHB Bank Berhad" <?php if($bc_row['cheque_no'] == 'BANKIN' && $bc_row['banker'] == 'RHB Bank Berhad'){ echo "selected"; }?>>RHB Bank Berhad</option>
                    <option value="Standard Chartered" <?php if($bc_row['cheque_no'] == 'BANKIN' && $bc_row['banker'] == 'Standard Chartered'){ echo "selected"; }?>>Standard Chartered</option>
                    <option value="UOB" <?php if($bc_row['cheque_no'] == 'BANKIN' && $bc_row['banker'] == 'UOB'){ echo "selected"; }?>>UOB</option>
                </select>
                </div>
                <div class="form-group">
                    <label>Dated</label>
                    <div class="input-group date form_datetime" data-date="" data-date-format="dd-mm-yyyy hh:ii:ss" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd hh:ii:ss">
                    <input class="form-control" size="16" type="text" id="bank_in_date" <?php if($bc_row['cheque_no'] == 'BANKIN'){ echo "value='$bc_row[in_date]'"; }?> disabled="disabled">
                    <span class="input-group-addon" style="pointer-events: none;" id="r_bankin_date"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon" style="pointer-events: none;" id="s_bankin_date"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <input type="hidden" name="bankin_date" id="dtp_input1" value="" />
                </div>
            </div>
    </div>  
</div>
      
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title"><input type="checkbox" id="cheque" name="cheque" value="cheque" onclick="validate()" <?php if($bc_row['cheque_no'] != 'BANKIN'){ echo 'checked'; }?> disabled> Cheque</h3>
    </header>
    <div class="panel-body">   
            <div class="col-md-12">
                <div class="form-group">
                <label>Cheque No</label>
                <input type="text" class="form-control" name="c_no" id="c_no" <?php if($bc_row['cheque_no'] != 'BANKIN'){ echo "value='$bc_row[cheque_no]'"; }?> disabled="disabled">
                </div>
                <div class="form-group">
                <label>Banker</label>
                <select name="banker" class="form-control" id="banker" disabled="disabled">
                    <option value="">Select The Bank</option>
                    <option value="Affin Bank Berhad" <?php if($bc_row['cheque_no'] != 'BANKIN' && $bc_row['banker'] == 'Affin Bank Berhad'){ echo "selected"; }?>>Affin Bank Berhad</option>
                    <option value="Alliance Bank" <?php if($bc_row['cheque_no'] != 'BANKIN' && $bc_row['banker'] == 'Alliance Bank'){ echo "selected"; }?>>Alliance Bank</option>
                    <option value="AmBank Berhad" <?php if($bc_row['cheque_no'] != 'BANKIN' && $bc_row['banker'] == 'AmBank Berhad'){ echo "selected"; }?>>AmBank Berhad</option>
                    <option value="CIMB Bank Berhad" <?php if($bc_row['cheque_no'] != 'BANKIN' && $bc_row['banker'] == 'CIMB Bank Berhad'){ echo "selected"; }?>>CIMB Bank Berhad</option>
                    <option value="Citibank Berhad" <?php if($bc_row['cheque_no'] != 'BANKIN' && $bc_row['banker'] == 'Citibank Berhad'){ echo "selected"; }?>>Citibank Berhad</option>
                    <option value="Hong Leong Bank Berhad" <?php if($bc_row['cheque_no'] != 'BANKIN' && $bc_row['banker'] == 'Hong Leong Bank Berhad'){ echo "selected"; }?>>Hong Leong Bank Berhad</option>
                    <option value="HSBC Bank Malaysia Berhad" <?php if($bc_row['cheque_no'] != 'BANKIN' && $bc_row['banker'] == 'HSBC Bank Malaysia Berhad'){ echo "selected"; }?>>HSBC Bank Malaysia Berhad</option>
                    <option value="Maybank" <?php if($bc_row['cheque_no'] != 'BANKIN' && $bc_row['banker'] == 'Maybank'){ echo "selected"; }?>>Maybank</option>
                    <option value="OCBC Bank Malaysia Berhad" <?php if($bc_row['cheque_no'] != 'BANKIN' && $bc_row['banker'] == 'OCBC Bank Malaysia Berhad'){ echo "selected"; }?>>OCBC Bank Malaysia Berhad</option>
                    <option value="Public Bank Berhad" <?php if($bc_row['cheque_no'] != 'BANKIN' && $bc_row['banker'] == 'Public Bank Berhad'){ echo "selected"; }?>>Public Bank Berhad</option>
                    <option value="RHB Bank Berhad" <?php if($bc_row['cheque_no'] != 'BANKIN' && $bc_row['banker'] == 'RHB Bank Berhad'){ echo "selected"; }?>>RHB Bank Berhad</option>
                    <option value="Standard Chartered" <?php if($bc_row['cheque_no'] != 'BANKIN' && $bc_row['banker'] == 'Standard Chartered'){ echo "selected"; }?>>Standard Chartered</option>
                    <option value="UOB" <?php if($bc_row['cheque_no'] != 'BANKIN' && $bc_row['banker'] == 'UOB'){ echo "selected"; }?>>UOB</option>
                </select>
                </div>
                <div class="form-group">
                    <label>Dated</label>
                    <div class="input-group date form_datetime" data-date="" data-date-format="dd-mm-yyyy hh:ii:ss" data-link-field="dtp_input" data-link-format="yyyy-mm-dd hh:ii:ss">
                    <input class="form-control" size="16" type="text" id="b_date" <?php if($bc_row['cheque_no'] != 'BANKIN'){ echo "value='$bc_row[in_date]'"; }?> disabled="disabled">
                    <span class="input-group-addon" style="pointer-events: none;" id="r_date"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon" style="pointer-events: none;" id="s_date"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <input type="hidden" name="dated" id="dtp_input" value="" />
                </div>
            </div>
    </div>  
</div>
            </div>
        </div>
        <div class="row">
        	<center><!--<button type="submit" class="btn btn-primary" name="submit" value="save"><i class=""></i> Save </button>-->
          
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