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

<form class="form-horizontal" method="post" action="f_receipt1.php" enctype="multipart/form-data"> 
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
<form class="form-horizontal" method="post" action="./f_receipt1.php" enctype="multipart/form-data"> 
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
										<option value="1">Pusat Kemahiran</option>
										<option value="2">Synergy Central</option>
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
								<option value="<?=$s_row['id']?>"><?=$s_row['s_name']?></option>
								<?php
								}
								?>
								</select>

							</div>

							<div class="form-group">
								<label>Student IC</label>
								<input class="form-control" name="ic" id="ic" type="text" value="" >
							</div>

							<div class="form-group">
								<label>Receipt Date</label>
								<div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
									<input class="form-control" size="16" type="text" value="" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
									<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
								</div>
								<input type="hidden" name="date" id="dtp_input2" value="" />
							</div>
                                
							<div class="form-group">
								<label>Remark</label>
								<input class="form-control" name="remark" id="remark" type="text" value="">
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
									<select name="p_type" id="bill_type" class="form-control" onChange="showbilldate(); return false;" required>
                                        <option value="choose">Choose</option>
                                    </select>
									<input type="checkbox" name="tl_payment" value="l_payment"   /> Last Payment
								</div>
								

								<div id="step3"></div>
								<div class="form-group">
                            	<button type="button" disabled='disabled' class="btn btn-danger" id="add_payment"><span></span>Add Description</button>
                                </div>
								<div class="form-group">
                                    <label style="color: red;">*For extra description, please keyin into remark at Step 2(e.g hostel fee payment duration month, or others.)</label>
                                </div>
                                <div class="form-group" style="margin-top:10px;">
                                    <div class="col-md-4" id="dcc">
                                        <input type="text" placeholder="desc" class="form-control" value="" name="desc[]" required/>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" id="pri" placeholder="Price" name="price[]" required/>

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
                                <div id="step4">
                                	
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
										<option value="b">Bank In</option>
										<option value="c">Cheque</option>
										<option value="cd">Credit Card</option>
										<option value="db">debit Card</option>
									</select>
								</div>

								<div id="step2"></div>

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
                .append('<option value="">Choose</option><option value="Debtor">Debtor</option><option value="Locker">Locker</option><option value="laptop deposit">Laptop deposit</option>');
        }else{
            $('#bill_type')
                .empty()
                .append('<option value="">Choose</option><option value="Debtor PTPK">Debtor PTPK</option><option value="Debtor">Debtor</option><option value="Internal Exam Fee">Internal Exam Fee</option><option value="Hostel Fee">Hostel Fee</option><option value="Hostel Deposit">Hostel Deposit</option><option value="Tuition Fee">Tuition Fee</option><option value="Tuition PTPK Auto debit">Tuition PTPK Auto debit</option><option value="Tuition PTPK Self pay">Tuition PTPK Self pay</option><option value="Personal Bond">Personal Bond</option><option value="Enrollment Fee">Enrollment Fee</option><option value="laptop deposit">Laptop deposit</option>');
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
	
	$('#bill_type').on('change',function(){
        
		$('.remove_project').parent().remove();
        
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
            variable="<input type='text' placeholder='Desc' name='desc[]' class='form-control' value='' required/>";
        }
        else if(name=="Hostel Fee"){
            // variable+="<select id='desc' class='form-control' name='desc[]' required>";
            // variable+="<option value='HOSTEL FEE'>HOSTEL FEE</option>";
            // variable+="<option value='HOSTEL UPGRADE'>HOSTEL UPGRADE</option>";
            // variable+="</select>";
			variable="<input type='text' placeholder='Desc' name='desc[]' class='form-control' value='' required/>";
           
        }
        else if(name=="Hostel Deposit"){
            variable+="<select id='desc' class='form-control' name='desc[]' required>";
            variable+="<option value='HOSTEL DEPOSIT'>HOSTEL DEPOSIT</option>";
            variable+="</select>";
			//variable="<input type='text' placeholder='Desc' name='desc[]' class='form-control' value='' required/>";
        }
        else if(name=="Debtor PTPK"){
            variable="<input type='text' placeholder='Desc' name='desc[]' class='form-control' value='' required/>";
        }
        else if(name=="Internal Exam Fee"){
            variable+="<select id='desc' name='desc[]' class='form-control' required>";
            variable+="<option value='INTERNAL EXAMINATION FEE'>INTERNEL EXAM FEE</option>";
            variable+="</select>";
        }
        else if(name=="Tuition PTPK Auto debit"){
            variable="<input type='text' placeholder='Desc' name='desc[]' class='form-control' value='' required/>";
        }
		else if(name=="Tuition PTPK Seft pay"){
            variable="<input type='text' placeholder='Desc' name='desc[]' class='form-control' value='' required/>";
        }
        else if(name=="Debtor"){
           variable="<input type='text' placeholder='Desc' name='desc[]' class='form-control' value='' required/>";
        }
        else if(name=="Locker"){
           variable="<input type='text' placeholder='Desc' name='desc[]' class='form-control' value='' required/>";
        }
        else if(name=="Personal Bond"){
           variable="<input type='text' placeholder='Desc' name='desc[]' class='form-control' value='' required/>";
        }
		else if(name=="Enrollment Fee"){
           variable="<input type='text' placeholder='Desc' name='desc[]' class='form-control' value='' required/>";
        }
		else if(name=="laptop deposit"){
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
		$.post('search_stu.php',{value:date_select},
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
		var date_select=$('#bill_type').val();
		$.post('billtype.php',{value:date_select},
		function(result){
			$('#step3').html(result);
		});
});


function calculation(num){
	document.getElementById("textbox1").value=num*5;
	document.getElementById("textbox2").value=(num*0.05)/document.getElementById("textbox1").value;
	var num1=document.getElementById("textbox1").value;
	var num2=document.getElementById("textbox2").value;
	document.getElementById("textbox3").value=num-num1-num2;
}
</script>