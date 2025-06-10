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
elseif(isset($_GET['action']) && $_GET['action'] == 'meg_hostel_exis'){
	$system_msg .= systemMsg('alert-warning','Warning!','This student is no record in hostel.');	
}

if(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_success_add'){
	
}
$qry = "SELECT *,date(r_date) AS r_date, s.id as stu_id FROM f_receipt AS f
		LEFT JOIN student AS s ON s.id = f.s_id
		WHERE f.r_status = 'ACTIVE' AND f.id = '".$_GET['id']."'";
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($result);

$chk_qry = "SELECT c_desc FROM f_cart";
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
$qry_rcp = "SELECT * FROM f_receipt";
$result_rcp = mysqli_query($conn, $qry_rcp);
$c_row = mysqli_num_rows($result_rcp);

$no = 10001;
$new_no = $no + $c_row;
?>
<style>
.tbl{
	
}
</style>
<form class="form-horizontal" method="post" action="f_receipt1.php?<?php echo $_GET['id']; ?>" enctype="multipart/form-data"> 
		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                <p>Receipt Form</p><!--<small><p class="pull-right" style="margin-top: -20px;">No: <?=$new_no?></p></small>-->
                </h1>
            </div>
        </div>
        
        <!--<div class="row">
            <div class="col-lg-6">
        
<!--<div class="panel panel-info">
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
                    <select name="desc" id="desc" class="form-control" <?=$require?>>
                        <option value="Tuition Fee" >Tuition Fee</option>
                        <option value="Hostel Fee" >Hostel Fee</option>
                        <option value="Exam Fee" >Exam Fee</option>
                        <option value="Insurance" 	>Insurance</option>
                        <option value="Enrollment Fee" >Enrollment Fee</option>
                        <option value="JPK" >JPK</option>
                        <option value="Security Deposit">Security Deposit (Hostel)</option>
                    </select>
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
</div>-->
			<!--</div>
            
            <div class="col-lg-6">

                <div class="form-group">
					<a class="btn btn-danger pull-right" href="f_receipt1.php?action=clear" onclick="return confirm('Confirm to clear all record?')"> Clear All </a><br />
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
				$qry_cart = "SELECT * FROM f_cart WHERE u_id = '".$_SESSION['id']."'";
				$result_cart = mysqli_query($conn, $qry_cart);
				$num=0;
				while($row_cart = mysqli_fetch_array($result_cart)){
					$num+=$row_cart['c_amount'];
					
				?>
				  <tr>
					<td><?=$row_cart['c_desc']?></td>
					<td><?=$row_cart['c_amount']?></td>
					<td><a class="btn btn-danger" href="f_receipt1.php?action=delete&id=<?=$row_cart['id']?>" onclick="return confirm('Confirm to Delete this Record?')"> Delete </a></td>
				  </tr>
				<?php }?>
				</table>
                <input type="hidden" name="sum" value="<?php echo $num; ?>" />
				</div>
				<br />

			</div>
        </div>-->
        
<br />
</form>
<form class="form-horizontal" method="post" action="f_receipt1.php?id=<?php echo $_GET['id'];?>" enctype="multipart/form-data"> 
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
										<option value="1" <?php if($row["receipt_type"]==1){echo "selected='selected'";} ?>>Pusat Kemahiran</option>
										<option value="2" <?php if($row["receipt_type"]==2){echo "selected='selected'";} ?>>Synergy Central</option>
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
					<h3 class="panel-title">Step 2</h3>
					</header>
					<div class="panel-body">
						<div class="col-md-6">
							<div class="form-group">
								<label>Student Name</label><br>
								<select class="selectpicker" name="name" id="name" data-live-search="true" required>
								<option value="">Choose</option>
								<?php
								$s_qty = "SELECT id,s_name FROM student WHERE s_status <> 'DELETE'";	
								$s_result = mysqli_query($conn, $s_qty);
								while($s_row = mysqli_fetch_array($s_result)){
								?>
								<option <?php if($s_row['id']==$row["stu_id"]){echo "selected='selected'";} ?> value="<?=$s_row['id']?>"><?=$s_row['s_name']?></option>
								<?php
								}
								?>
								</select>
							</div>

							<div class="form-group">
								<label>Student IC</label>
								<input class="form-control" name="ic" id="ic" type="text" value="<?=$row["ic"]?>" readonly>
							</div>

							<div class="form-group">
								<label>Receipt Date</label>
								<div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
									<input class="form-control" size="16" type="text" value="<?=$row["r_date"]?>" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
									<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
								</div>
								<input type="hidden" name="date" id="dtp_input2" value="<?=$row["r_date"]?>" />
							</div>
                                
							<div class="form-group">
								<label>Remark</label>
								<input class="form-control" name="remark" id="remark" type="text" value="<?=$row["remark"]?>">
							</div>
                            <div class="form-group">
								<label>Not print</label>
                                <span><input  name="c_remark" id="c_remark" type="checkbox">mark if need edit</span>
								<input readonly class="form-control" name="new_remark" id="new_remark" type="text" value="<?=$row["new_remark"]?>">
							</div>
						</div>
					</div>
				</div>  
			</div>
        </div>
<hr />
		<div class="row">
        	<div class="col-lg-12">
            	<div class="panel panel-info">
                	<header class="panel-heading">
                    	<h4>Step 3</h4>
                    </header>
                    <div class="panel-body">
                    	<div class="col-md-12">
								<div class="form-group">
                                <label>Bill Option</label>
									<label>Payment Option</label>
                                    
	<select name="p_type" id="bill_type" class="form-control" onChange="showbilldate() return false;" required>
        <option value="choose">Choose</option>
		<option value="Debtor PTPK" <?php if($row["cash_bill_option"]=="Debtor PTPK"){echo "selected='selected'";} ?> >Debtor PTPK</option>
		<option value="Debtor" <?php if($row["cash_bill_option"]=="Debtor"){echo "selected='selected'";} ?>>Debtor</option>
		<option value="Internal Exam Fee" <?php if($row["cash_bill_option"]=="Internal Exam Fee"){echo "selected='selected'";} ?>>Internal Exam Fee</option>
		<option value="Hostel Fee" <?php if($row["cash_bill_option"]=="Hostel Fee"){echo "selected='selected'";} ?>>Hostel Fee</option>
		<option value="Tuition Fee" <?php if($row["cash_bill_option"]=="Tuition Fee"){echo "selected='selected'";} ?>>Tuition Fee</option>
        <option value="Tuition PTPK" <?php if($row["cash_bill_option"]=="Tuition PTPK"){echo "selected='selected'";} ?>>Tuition PTPK</option>
        <option value="Enrollment Fee" <?php if($row["cash_bill_option"]=="Enrollment Fee"){echo "selected='selected'";} ?>>Enrollment Fee</option>
	</select>
								</div>

								<div id="step3">
								    
								</div>
                            
                                
                            
								<div class="form-group">
                                
                            	<button type="button"  class="btn btn-danger" id="add_payment"><span></span>Add Description</button> 
                                <!--<a class="btn btn-success" href="receipt1.php">Save description</a>-->
                                </div>
								<div class="form-group">
                                    <label style="color: red;">*For extra description, please keyin into remark at Step 2(e.g hostel fee payment duration month, or others.)</label>
                                </div>
                                <div class="form-group" style="margin-top:10px;">
                                    <div class="col-md-4" id="dcc">
                                        <input type="text" placeholder="desc" class="form-control" value="" name="desc[]" />
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" id="pri" placeholder="Price" name="price[]" />

                                    </div>
                                    <div class="col-md-2">
									<select name="level[]" id="level" class="form-control">
										<option value="">register</option>
										<option value="LEVEL 2">LEVEL 2</option>
										<option value="LEVEL 3">LEVEL 3</option>
										<option value="LEVEL 4">LEVEL 4</option>
										<option value="Singer Tier">Singer Tier</option>
    								</select>
									</div>
                                </div>
                            
                                <?php
	$bc_qry = "SELECT *,date(in_date) AS in_date FROM f_b_c WHERE r_id = '".$_GET['id']."'";
	$bc_result = mysqli_query($conn,$bc_qry);
	$bc_row = mysqli_fetch_array($bc_result);
	$bc_rows = mysqli_num_rows($bc_result);
?>

                                <div id="step4">
                                	
                                </div>
                            <div class="form-group" >
                                    <table class="table table-bordred table-striped">
                                        <thead>
                                           
                                            <th>Date</th>
                                            <th>description</th>
                                            <th>price</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                           <?php 
                                            $query="select *, DATE_FORMAT(r_date,'%d/%m/%Y') as newdate,rd.id as newid from f_receipt_detail as rd inner join f_receipt as r on r.id=rd.r_id where rd.r_id='".$_GET["id"]."'";
                                            $sttr=mysqli_query($conn,$query);
                                            while($result_sttr=mysqli_fetch_array($sttr)){
                                                echo "<tr>";
                                                echo "<td>".$result_sttr["newdate"]."</td>";
                                                echo "<td>".$result_sttr["rp_desc"]."</td>";
                                                echo "<td>".$result_sttr["rp_amount"]."</td>";
                                                echo "<td><a class='btn btn-danger' href='f_rp_detail1.php?action=deleterd&id=".$result_sttr['newid']."&rid=".$_GET['id']."'>Delete</a></td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                             
                                        </tbody>
                                    </table>
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
					<h3 class="panel-title">Step 4</h3>
					</header>
					<div class="panel-body"> 
							<div class="col-md-12">
								<div class="form-group">
                                    <select name="boc" class="form-control" id="boc">
										<option value="">Choose</option>
										<option value="b" <?php if($bc_rows > 0 && $row['pay_mtd'] == 'bankin' && $bc_row['cheque_no'] == 'BANKIN'){ echo 'selected';}?>>Bank In</option>
										<option value="c" <?php if($bc_rows > 0 && $row['pay_mtd'] == 'cheque' && $bc_row['cheque_no'] != 'BANKIN'){ echo 'selected';}?><?php if($row[21] == $s_row['id']){ echo 'selected';}?>>Cheque</option>
                                        <option value="cd" <?php if($bc_rows > 0 && $row['pay_mtd'] == 'credit card' && $bc_row['cheque_no'] != 'BANKIN'){ echo 'selected';}?><?php if($row[21] == $s_row['id']){ echo 'selected';}?>>credit card</option>
                                        <option value="db" <?php if($bc_rows > 0 && $row['pay_mtd'] == 'debit card' && $bc_row['cheque_no'] != 'BANKIN'){ echo 'selected';}?><?php if($row[21] == $s_row['id']){ echo 'selected';}?>>debit card</option>
									</select>
								</div>

								<div id="step2"></div>

							</div>
					</div>  
				</div>
            </div>
        </div>
        
        <div class="row">
        	<center><button type="submit" class="btn btn-primary" name="edit" value="edit"><i class=""></i> edit </button>
          
              <!--<a class="btn btn-primary" href="print_feeRefund.php"> Print Fee Refund Letter </a>-->
             
            </center>
            <input type="hidden"  name="r_no" value="<?=$new_no?>"/>
        </form>
        </div>
        
<?php require('footer.php');?>

<script>
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
		if(selected == '1'){
            $('#bill_type')
                .empty()
                .append('<option value="">Choose</option><option value="Debtor">Debtor</option><option value="Locker">Locker</option>');
        }else{
            
            $('#bill_type')
                .empty()
                .append('<option value="">Choose</option><option value="Debtor PTPK">Debtor PTPK</option><option value="Debtor">Debtor</option><option value="Internal Exam Fee">Internal Exam Fee</option><option value="Hostel Fee">Hostel Fee</option><option value="Hostel Deposit">Hostel Deposit</option><option value="Tuition Fee">Tuition Fee</option><option value="Tuition PTPK">Tuition PTPK</option><option value="Personal Bond">Personal Bond</option><option value="Enrollment Fee">Enrollment Fee</option>');
        }
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
	$(document).ready(function() {
		var boc =  $('#boc').val();
		var pay_mtd =  '<?=$row['pay_mtd']?>';
		var cheque_no =  '<?=$bc_row['cheque_no']?>';
		var banker =  '<?=$bc_row['banker']?>';
		var in_date =  '<?=$bc_row['in_date']?>';
		var payment_reference =  '<?=$bc_row['payment_reference']?>';
			//use ajax to run the check  
			$.post("payment_type.php", { value: boc, pay_mtd: pay_mtd, cheque_no: cheque_no, banker: banker, in_date: in_date, payment_reference: payment_reference},  
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
	$('#bill_type').on('change',function(){
        
		$('.remove_project').parent().remove();
        var id=<?php echo $_GET['id'];?>;
		var date_select=$('#bill_type').val();
        var name=$('#bill_type').val();
        var variable="";
        if(name=="choose"){
            $("#add_payment").attr('disabled','disabled');
        }
        else{
            $("#add_payment").removeAttr('disabled');
        }
        if(name=="Tuition Fee"){
            variable="<input type='text' placeholder='Desc' name='desc[]' class='form-control' value='' />";
        }
        else if(name=="Hostel Fee"){
            variable+="<select id='desc' class='form-control' name='desc[]' >";
            variable+="<option value='HOSTEL FEE'>HOSTEL FEE</option>";
            variable+="<option value='HOSTEL UPGRADE'>HOSTEL UPGRADE</option>";
            variable+="</select>";
           
        }
        else if(name=="Hostel Deposit"){
            variable+="<select id='desc' class='form-control' name='desc[]' >";
            variable+="<option value='HOSTEL DEPOSIT'>HOSTEL DEPOSIT</option>";
            variable+="</select>";
           
        }
        else if(name=="Debtor PTPK"){
            variable="<input type='text' placeholder='Desc' name='desc[]' class='form-control' value='' />";
        }
        else if(name=="Internal Exam Fee"){
            variable+="<select id='desc' name='desc[]' class='form-control' >";
            variable+="<option value='INTERNAL EXAMINATION FEE'>INTERNEL EXAM FEE</option>";
            variable+="</select>";
        }
        else if(name=="Tuition PTPK"){
            variable="<input type='text' placeholder='Desc' name='desc[]' class='form-control' value='' />";
            
        }
        else if(name=="Debtor"){
           variable="<input type='text' placeholder='Desc' name='desc[]' class='form-control' value='' />";
        }
        else if(name=="Locker"){
           variable="<input type='text' placeholder='Desc' name='desc[]' class='form-control' value='' />";
        }
        else if(name=="Personal Bond"){
           variable="<input type='text' placeholder='Desc' name='desc[]' class='form-control' value='' />";
        }
        else if(name=="Enrollment Fee"){
           variable="<input type='text' placeholder='Desc' name='desc[]' class='form-control' value='' required/>";
        }
        
        $('#dcc').html(variable);
        
		$.post('billtype.php',{value:date_select},
		function(result){
			$('#step3').html(result);
            
            
		});
});
$('#name').on('change',function(){
		var date_select=$('#name').val();
		$.post('search_stu.php',{value:date_select,id:id},
		function(result){
			if(result=="Programming"){
			    $(".pro").attr("selected","selected");
			}
            else if(result=="Networking"){
                 $(".net").attr("selected","selected");
            }
            else if(result=="Multimedia"){
                 $(".mul").attr("selected","selected");
            }
            else if(result=="Electronic"){
                 $(".ele").attr("selected","selected");
            }
            else if(result=="Acounting"){
                 $(".acc").attr("selected","selected");
            }
		});
});

$('#step4').on('click', '.remove_project', function(e){
		e.preventDefault();
		$(this).parent().remove();
});
$("#c_remark").change(function() {
    if(this.checked) {
        $('#new_remark').removeAttr("readonly");
    }
    else{
        $('#new_remark').prop("readonly",true);
    }
});

	$('#level').on("change",function(){
        var dcc=$("#bill_type").val();
        var lvl=$("#level").val();
        var course=$("#c_id").val();
        //alert(lvl);
        if(dcc=="Internal Exam Fee"){
            if((course=="Programming" ||course=="Multimedia"|| course=="Electronic" || course=="Networking" || course=="ACCOUNTING") && (lvl=="LEVEL 2" || lvl=="LEVEL 3")){
                $("#pri").val("100");
            }else if((course=="Accounting" || course=="Networking") && lvl=="LEVEL 4"){
                $("#pri").val("150");
            }
            else{
                $("#pri").val("100");
            }
        }
        
	    
	});
	$('#add_payment').on('click',function(){
		var date_select=$('#bill_type').val();
		
        var asd=$("#bill_type").val();
        var course=$("#c_id").val();
       
		$.post('payment_detail.php',{value:date_select,course:course,asd:asd},
		function(result){
			$("#step4").append(result);
             if(course=="Programming"){
			    $(".pro").attr("selected","selected");
			}
            else if(course=="Networking"){
                 $(".net").attr("selected","selected");
            }
            else if(course=="Multimedia"){
                 $(".mul").attr("selected","selected");
            }
            else if(course=="Electronic"){
                 $(".ele").attr("selected","selected");
            }
            else if(course=="Acounting"){
                 $(".acc").attr("selected","selected");
            }
			
		});
});


$(document).ready(function() {
    $('.remove_project').parent().remove();
        var selected = $('#c_type').val();
        
		if(selected == '1'){
            var b='<?php echo $row['cash_bill_option'];?>';
        var dep2="";
        var lock="";
        if(b=="Debtor"){
                 dep2="selected='selected'";
            }else if(b=="Locker"){
                 lock="selected='selected'";
            }
            $('#bill_type')
                .empty()
                .append('<option value="">Choose</option><option value="Debtor"'+dep2+'>Debtor</option><option value="Locker"'+lock+'>Locker</option>');
        }else{
            
            var a='<?php echo $row['cash_bill_option'];?>';
            
            var s_dpttk="";
            var s_dep="";
            var s_int="";
            var s_hos="";
            var s_hosd="";
            var s_tptpk="";
            var s_tf="";
            var s_pb=""; 
            var s_end=""   
            if(a=="Debtor PTPK"){
                 s_dpttk="selected='selected'";
            }else if(a=="Debtor"){
                 s_dep="selected='selected'";
            }else if(a=="Internal Exam Fee"){
                 s_int="selected='selected'";
            }else if(a=="Hostel Fee"){
                 s_hos="selected='selected'";
            }else if(a=="Hostel Deposit"){
                 s_hosd="selected='selected'";
            }else if(a=="Tuition PTPK"){
                 s_tptpk="selected='selected'";
            }else if(a=="Tuition Fee"){
                 s_tf="selected='selected'";
            }else if(a=="Personal Bond"){
                 s_pb="selected='selected'";
            }else if(a=="Enrollment Fee"){
                s_end="selected='selected'";
            }
            $('#bill_type')
                .empty()
                .append('<option value="">Choose</option><option value="Debtor PTPK"'+s_dpttk+' >Debtor PTPK</option><option value="Debtor" '+s_dep+' >Debtor</option><option value="Internal Exam Fee" '+s_int+' >Internal Exam Fee</option><option value="Hostel Fee" '+s_hos+'>Hostel Fee</option><option value="Hostel Deposit" '+s_hosd+'>Hostel Deposit</option><option value="Tuition Fee" '+s_tf+'>Tuition Fee</option><option value="Tuition PTPK" '+s_tptpk+' >Tuition PTPK</option><option value="Personal Bond" '+s_pb+'>Personal Bond</option><option value="Enrollment Fee">Enrollment Fee</option>');
        }
		var date_select=$('#bill_type').val();
        var name=$('#bill_type').val();
        var variable="";
        if(name=="choose"){
            $("#add_payment").attr('disabled','disabled');
        }
        else{
            $("#add_payment").removeAttr('disabled');
        }
        if(name=="Tuition Fee"){
            variable="<input type='text' placeholder='Desc' name='desc[]' class='form-control' value='' />";
        }
        else if(name=="Hostel Fee"){
            variable+="<select id='desc' class='form-control' name='desc[]' >";
            variable+="<option value='HOSTEL FEE'>HOSTEL FEE</option>";
            variable+="<option value='HOSTEL UPGRADE'>HOSTEL UPGRADE</option>";
            variable+="</select>";
           
        }
        else if(name=="Hostel Deposit"){
            variable+="<select id='desc' class='form-control' name='desc[]' >";
            variable+="<option value='HOSTEL DEPOSIT'>HOSTEL DEPOSIT</option>";
            variable+="</select>";
           
        }
        else if(name=="Debtor PTPK"){
            variable="<input type='text' placeholder='Desc' name='desc[]' class='form-control' value='' />";
        }
        else if(name=="Internal Exam Fee"){
            variable+="<select id='desc' name='desc[]' class='form-control'>";
            variable+="<option value='INTERNAL EXAMINATION FEE'>INTERNEL EXAM FEE</option>";
            variable+="</select>";
        }
        else if(name=="Tuition PTPK"){
            variable="<input type='text' placeholder='Desc' name='desc[]' class='form-control' value='' />";
            
        }
        else if(name=="Debtor"){
           variable="<input type='text' placeholder='Desc' name='desc[]' class='form-control' value='' />";
        }
        else if(name=="Locker"){
           variable="<input type='text' placeholder='Desc' name='desc[]' class='form-control' value='' />";
        }
        else if(name=="Personal Bond"){
           variable="<input type='text' placeholder='Desc' name='desc[]' class='form-control' value='' />";
        }
        
        $('#dcc').html(variable);
        
		$.post('billtype.php',{value:date_select},
		function(result){
			$('#step3').html(result);
            
		});
        
		var date_select=$('#bill_type').val();
        var id=<?php echo $_GET['id'];?>;
        
		$.post('billtype.php',{value:date_select,id:id},
		function(result){
			$('#step3').html(result);
		});
});
	
</script>