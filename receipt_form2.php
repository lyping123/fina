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

if(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_success_add'){
	
}

  //  $chk_qry = "SELECT id FROM cart";
//    $chk_result = mysqli_query($conn, $chk_qry);
//	if (mysqli_num_rows($chk_result) > 0) { 
//		  $_SESSION["e"] = "";
//	}else{
//		  $_SESSION["e"] = 'required'	;
//	}

?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
<?php
$qry_rcp = "SELECT * FROM receipt";
$result_rcp = mysqli_query($conn, $qry_rcp);
$c_row = mysqli_num_rows($result_rcp);

$no = 10001;
$new_no = $no + $c_row;
?>
<form class="form-horizontal" method="post" action="receipt.php" enctype="multipart/form-data"> 
		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                <p>Receipt Form</p><small><p class="pull-right" style="margin-top: -20px;">No: <?=$new_no?></p></small>
                </h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6">
        
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Cart Details</h3>
    </header>
    <div class="panel-body">
           
            <div class="col-md-12">
                <div class="form-group">
                    <label>Description</label>
                    <select id="desc"  name="desc" id="desc" class="form-control" >
                <option value="Tuition Fee" >Tuition Fee</option>
                <option value="Hostel Fee" >Hostel Fee</option>
                <option value="Exam Fee" >Exam Fee</option>
                <option value="Insurance" >Insurance</option>
                <option value="Enrollment Fee" >Enrollment Fee</option>
               <option value="JPK" >JPK</option>
               <option value="Security Deposit">Security Deposit (Hostel)</option>
            </select>
                </div>
                <div class="form-group">
                    <label>Amount</label>
                    <input id="amt" type="text" class="form-control" name="amount" value="" >
                </div>
               
                  <br />
                <div class="form-group " style="text-align: center">
                    <button type="submit" class="btn btn-primary btn-block" name="submit" value="add" onclick="validate3()"><i class=""></i> Add </button>
                </div>
                
            </div>
            
            
     
    </div>  
</div>
			</div>
            
            <div class="col-lg-6">

                <div class="form-group">
					<a class="btn btn-danger pull-right" href="receipt.php?action=clear" onclick="return confirm('Confirm to clear all record?')"> Clear All </a><br />
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
<table id="t_cart" style="width:100%">
  <tr>
    <th>Description</th>
    <th>Amount</th>
    <th>Action</th>
  </tr>
<?php
$qry_cart = "SELECT * FROM cart";
$result_cart = mysqli_query($conn, $qry_cart);
while($row_cart = mysqli_fetch_array($result_cart)){
?>
  <tr>
    <td><?=$row_cart['c_desc']?></td>
    <td><?=$row_cart['c_amount']?></td>
    <td><a class="btn btn-danger" href="receipt.php?action=delete&id=<?=$row_cart['id']?>" onclick="return confirm('Confirm to Delete this Record?')"> Delete </a></td>
  </tr>
<?php }?>
</table>
</div>
<br />

			</div>
        </div>
        
<hr />

        <div class="row">
            <div class="col-lg-12">

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
    <h3 class="panel-title">Add New Receipt</h3>
    </header>
    <div class="panel-body">  
    <div class="col-md-6">
            <div class="form-group">
                    <label>Student Name</label>
                    <div id="basic-example">
            		<input id="my-input1" class="form-control typeahead" name="name" type="text" value="" style="width:523px;" onfocusout="showHint(this.value);" required="required">
        			</div>
                </div>
                <div id="txtHint"></div>
                <!--<div class="form-group">
                    <label>IC</label>
                    <input type="text" class="form-control" name="ic" value="" required="required">
                </div>-->
                <div class="form-group">
                    <label>Receipt Date</label>
                    <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input id="my-input2" class="form-control" size="16" type="text" value="" required="required">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <input type="hidden" name="date" id="dtp_input2" value="" />
                </div>
               
               
            </div>
          
          
          <div class="col-lg-12">

 <div class="col-md-6"> 
 <div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title"><input type="checkbox" id="bankin" name="bankin" value="bankin" onclick="validate1()"> Bank In</h3>
    </header>
    <div class="panel-body"> 
            <div class="col-md-12">
                <div class="form-group">
                <label>Banker</label>
                <select name="bankin_banker" class="form-control" id="bankin_banker" disabled="disabled">
                    <option value="">Select The Bank</option>
                    <option value="Affin Bank Berhad">Affin Bank Berhad</option>
                    <option value="Alliance Bank">Alliance Bank</option>
                    <option value="AmBank Berhad">AmBank Berhad</option>
                    <option value="CIMB Bank Berhad">CIMB Bank Berhad</option>
                    <option value="Citibank Berhad">Citibank Berhad</option>
                    <option value="Hong Leong Bank Berhad">Hong Leong Bank Berhad</option>
                    <option value="HSBC Bank Malaysia Berhad">HSBC Bank Malaysia Berhad</option>
                    <option value="Maybank">Maybank</option>
                    <option value="OCBC Bank Malaysia Berhad">OCBC Bank Malaysia Berhad</option>
                    <option value="Public Bank Berhad">Public Bank Berhad</option>
                    <option value="RHB Bank Berhad">RHB Bank Berhad</option>
                    <option value="Standard Chartered">Standard Chartered</option>
                    <option value="UOB">UOB</option>
                </select>
                </div>
                <div class="form-group">
                    <label>Dated</label>
                    <div class="input-group date form_datetime" data-date="" data-date-format="dd-mm-yyyy hh:ii:ss" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd hh:ii:ss">
                    <input class="form-control" size="16" type="text" value="" id="bank_in_date" disabled="disabled">
                    <span class="input-group-addon" style="pointer-events: none;" id="r_bankin_date"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon" style="pointer-events: none;" id="s_bankin_date"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <input type="hidden" name="bankin_date" id="dtp_input1" value="" />
                </div>
            </div>
    </div>  
</div>    
 
            
</div>
<div class="col-lg-6">
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title"><input type="checkbox" id="cheque" name="cheque" value="cheque" onclick="validate()"> Cheque</h3>
    </header>
    <div class="panel-body">   
            <div class="col-md-12">
                <div class="form-group">
                <label>Cheque No</label>
                <input type="text" class="form-control" name="c_no" id="c_no" value="" disabled="disabled">
                </div>
                <div class="form-group">
                <label>Banker</label>
                <select name="banker" class="form-control" id="banker" disabled="disabled">
                    <option value="">Select The Bank</option>
                    <option value="Affin Bank Berhad">Affin Bank Berhad</option>
                    <option value="Alliance Bank">Alliance Bank</option>
                    <option value="AmBank Berhad">AmBank Berhad</option>
                    <option value="CIMB Bank Berhad">CIMB Bank Berhad</option>
                    <option value="Citibank Berhad">Citibank Berhad</option>
                    <option value="Hong Leong Bank Berhad">Hong Leong Bank Berhad</option>
                    <option value="HSBC Bank Malaysia Berhad">HSBC Bank Malaysia Berhad</option>
                    <option value="Maybank">Maybank</option>
                    <option value="OCBC Bank Malaysia Berhad">OCBC Bank Malaysia Berhad</option>
                    <option value="Public Bank Berhad">Public Bank Berhad</option>
                    <option value="RHB Bank Berhad">RHB Bank Berhad</option>
                    <option value="Standard Chartered">Standard Chartered</option>
                    <option value="UOB">UOB</option>
                </select>
                </div>
                <div class="form-group">
                    <label>Dated</label>
                    <div class="input-group date form_datetime" data-date="" data-date-format="dd-mm-yyyy hh:ii:ss" data-link-field="dtp_input" data-link-format="yyyy-mm-dd hh:ii:ss">
                    <input class="form-control" size="16" type="text" value="" id="b_date" disabled="disabled">
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
<div class="col-lg-12">   
    <div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Tuition Fee</h3>
    </header>
    <div class="panel-body">  
            <div class="col-lg-6">
                 <div class="form-group">
                      <input type="checkbox" id="tuition" name="tuition" value="tuition" onclick="validate2()"> Deduct From Tuition Fee
                  </div>              
                </div>
            <div class="col-md-12">
                <div class="form-group">
					<input type="checkbox" id="c_loan" name="c_loan" value="loan" disabled="disabled"> Loan from PTPK
                </div>
            </div>
            </div>
    </div>  
</div>
</div>            
    </div>  
    
  
</div>


            </div>
            
            
        </div>
        <div class="row">
        	<center><button type="submit" class="btn btn-primary" name="submit" value="save" onclick="validate4()"><i class=""></i> Save </button>
          
              <a class="btn btn-primary" href="print_feeRefund.php"> Print Fee Refund Letter </a>
             
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
		document.getElementById('c_loan').disabled = false;
	} else {
		document.getElementById('c_loan').disabled = true;
		document.getElementById('c_loan').checked = false;
	}
}
function validate3(){
	document.getElementById("my-input1").required = false;
	document.getElementById("my-input2").required = false;
	document.getElementById("desc").required = true;
	document.getElementById("amt").required = true;
}
function validate4(){
	document.getElementById("my-input1").required = true;
	document.getElementById("my-input2").required = true;
	
	 var tbl = document.getElementById("t_cart").rows.length;
	  if( tbl<2){
		  document.getElementById("desc").required = true;
	      document.getElementById("amt").required = true;
	  }else{
		  document.getElementById("desc").required = false;
		  document.getElementById("amt").required = false;
	  }
}
</script>
<?php require('footer.php');?>