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
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_fail_edit'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to Edit receipt details.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_fail_edit1'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to Edit receipt details.(Payment Method)');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_bankin_success_edit'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully edit receipt details.');	
}

echo $qry = "SELECT *,date(r_date) AS r_date FROM f_receipt AS f
		LEFT JOIN student AS s ON s.id = f.s_id
		WHERE f.r_status = 'ACTIVE' AND f.id = '".$_GET['id']."'";
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
<form class="form-horizontal" method="post" action="f_rp_detail1.php?id=<?=$row[0]?>" enctype="multipart/form-data"> 
		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                <p>Edit Cash Bill</p><!--<small><p class="pull-right" style="margin-top: -20px;">No: <?=$new_no?></p></small>-->
                </h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
				<div class="panel panel-info">
					<header class="panel-heading">
					<h3 class="panel-title">Step 1</h3>
					</header>
					<div class="panel-body"> 
							<div class="col-md-12">
								<div class="form-group">
									<select name="c_type" class="form-control" id="c_type" required>
										<option value="">Choose</option>
										<option <?php if($row["receipt_type"]==1){echo "selected='selected'";} ?> value="1">Pusat Kemahiran</option>
										<option <?php if($row["receipt_type"]==2){echo "selected='selected'";} ?> value="2">Synergy Central</option>
									</select>
								</div>
							</div>
					</div>  
				</div>
            </div>
        </div>
        
<hr />
</form>
<form class="form-horizontal" method="post" action="f_receipt1.php?action=edit&id=<?=$_GET['id']?>" enctype="multipart/form-data"> 
       <div class="row">
            <div class="col-lg-12">
				<div class="panel panel-info">
					<header class="panel-heading">
					<h3 class="panel-title">Cash Bill Type</h3>
					</header>
					<div class="panel-body"> 
							<div class="col-md-12">
								<div class="form-group">
									<select name="c_type" class="form-control" id="c_type" required>
										<option value="">Choose</option>
										<option value="1" <?php if($row['receipt_type'] == '1'){ echo "selected";}?>>Pusat Kemahiran</option>
										<option value="2" <?php if($row['receipt_type'] == '2'){ echo "selected";}?>>Synergy Central</option>
									</select>
								</div>
							</div>
					</div>  
				</div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
				<div class="panel panel-info">
					<header class="panel-heading">
					<h3 class="panel-title">Student Information</h3>
					</header>
					<div class="panel-body">
						<div class="col-md-6">
							<div class="form-group">
								<label>Student Name</label><br>
								<select class="selectpicker" name="name" id="name" data-live-search="true">
								<option value="">Choose</option>
								<?php
								$s_qty = "SELECT id,s_name FROM student WHERE s_status = 'ACTIVE'";	
								$s_result = mysqli_query($conn, $s_qty);
								while($s_row = mysqli_fetch_array($s_result)){
								?>
								<option value="<?=$s_row['id']?>" <?php if($row[21] == $s_row['id']){ echo 'selected';}?>><?=$s_row['s_name']?></option>
								<?php
								}
								?>
								</select>
							</div>

							<div class="form-group">
								<label>Student IC</label>
								<input class="form-control" name="ic" id="ic" type="text" value="<?php if(!empty($row['s_ic'])){ echo $row['s_ic'];}else{ echo $row['ic'];}?>" readonly>
							</div>

							<div class="form-group">
								<label>Receipt Date</label>
								<div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
									<input class="form-control" size="16" type="text" value="<?=$row['r_date']?>" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
									<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
								</div>
								<input type="hidden" name="date" id="dtp_input2" value="" />
							</div>
								<div id="step1"></div>

							<div class="form-group">
								<label>Remark</label>
								<input class="form-control" name="remark" id="remark" type="text" value="<?=$row['remark']?>">
							</div>
						</div>
					</div>
				</div>  
			</div>
        </div>
<hr />

<?php
	$bc_qry = "SELECT *,date(in_date) AS in_date FROM f_b_c WHERE r_id = '".$_GET['id']."'";
	$bc_result = mysqli_query($conn,$bc_qry);
	$bc_row = mysqli_fetch_array($bc_result);
	$bc_rows = mysqli_num_rows($bc_result);
?>

        <div class="row">
            <div class="col-lg-12">
				<div class="panel panel-info">
					<header class="panel-heading">
					<h3 class="panel-title">Bankin or Cheque</h3>
					</header>
					<div class="panel-body"> 
							<div class="col-md-12">
								<div class="form-group">
									<select name="boc" class="form-control" id="boc">
										<option value="">Choose</option>
										<option value="b" <?php if($bc_rows > 0 && $row['pay_mtd'] == 'bankin' && $bc_row['cheque_no'] == 'BANKIN'){ echo 'selected';}?>>Bank In</option>
										<option value="c" <?php if($bc_rows > 0 && $row['pay_mtd'] == 'cheque' && $bc_row['cheque_no'] != 'BANKIN'){ echo 'selected';}?><?php if($row[21] == $s_row['id']){ echo 'selected';}?>>Cheque</option>
									</select>
								</div>

								<div id="step2"></div>

							</div>
					</div>  
				</div>
            </div>
        </div>
        
        <div class="row">
        	<center><button type="submit" class="btn btn-primary" name="submit" value="edit"><i class=""></i> Save </button>
          
              <!--<!--<a class="btn btn-primary" href="print_feeRefund.php"> Print Fee Refund Letter </a>-->
             
            </center>
            <input type="hidden"  name="r_no" value="<?=$new_no?>"/>
        </form>
        </div>
        
<?php require('footer.php');?>
<script>
	
	$( document ).ready(function() {
			var selected = $('#c_type').val();
		var cash_bill_option = '<?=$row['cash_bill_option']?>';
			//alert(selected);
				//use ajax to run the check  
			$.post("cash_bill_type.php", { value: selected, cbo: cash_bill_option },  
				function(result){  
					$( "#step1" ).html(result);
				});  
	});

	$(document).ready(function() {
		var boc =  $('#boc').val();
		var pay_mtd =  '<?=$row['pay_mtd']?>';
		var cheque_no =  '<?=$bc_row['cheque_no']?>';
		var banker =  '<?=$bc_row['banker']?>';
		var in_date =  '<?=$bc_row['in_date']?>';
			//use ajax to run the check  
			$.post("payment_type.php", { value: boc, pay_mtd: pay_mtd, cheque_no: cheque_no, banker: banker, in_date: in_date},  
				function(result){  
					$( "#step2" ).html(result);
				
					$('.form_date').datetimepicker({
						language:  'fr',
						weekStart: 1,
						todayBtn:  1,
						autoclose: 1,
						todayHighlight: 1,
						startView: 2,
						minView: 2,
						forceParse: 0
					});
				});  
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
	
	$('#c_type').on('change', function(){
		var selected = $('#c_type').val();
		var cash_bill_option = '<?=$row['cash_bill_option']?>';
		//alert(selected);
			//use ajax to run the check  
		$.post("cash_bill_type.php", { value: selected, cbo: cash_bill_option },  
			function(result){  
				$( "#step1" ).html(result);
			});  
	});
	

	$('#boc').change(function(){
		var boc =  $('#boc').val();
			//use ajax to run the check  
			$.post("payment_type.php", { value: boc},  
				function(result){  
					$( "#step2" ).html(result);
				
					$('.form_date').datetimepicker({
						language:  'fr',
						weekStart: 1,
						todayBtn:  1,
						autoclose: 1,
						todayHighlight: 1,
						startView: 2,
						minView: 2,
						forceParse: 0
					});
				});  
	});
</script>