<?php 
require ('include/db.php');
$value=$_POST['value'];

if($value==1){
    $qry="select * from duration where receipt_id='".$_POST['id']."'";
    $sttr=mysqli_query($conn,$qry);
    $result=mysqli_fetch_array($sttr);
?>
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="pd" data-link-format="yyyy-mm-dd">
                                        <input class="form-control" size="16" type="text" placeholder="Payment Date" value="<?=$result['paymentDate']?>" required="required">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <input type="hidden" name="pd" id="pd" value="<?=$result['paymentDate']?>"/>
                                </div>
                                <div class="form-group">
                                    <label>End Month</label>
                                    <div class="input-group date form_month" data-date="" data-date-format="mm-yyyy" id="pum1" data-link-field="pum" data-link-format="mm-yyyy">
                                        <input class="form-control" size="16" type="text" placeholder="Pay Until Month" value="<?=$result['pay_until']?>" required="required">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <input type="hidden" name="pum" id="pum" value="<?=$result['pay_until']?>"/>
                                </div>
                                <div class="form-group">
                                	<input type="checkbox" name="l_payment" id="lp"> Last Payment
								</div>
                                <div class="form-group" id="npd">
                                    <label>Next Payment Date</label>
                                    <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="npd1" data-link-format="yyyy-mm-dd">
                                        <input class="form-control" size="16" type="text" placeholder="Next Payment Date" value="<?=$result['next_payment']?>" required="required" id='npdate'>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <input type="hidden" name="npd" id="npd1" value="<?=$result['next_payment']?>"/>
                                </div><?php }?>
                               
								
<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
	$('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0,
		pickerPosition: "top-left"
    });
	$('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
	$('.form_month').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 3,
		minView: 3,
		maxView: 1,
		forceParse: 0,
		pickerPosition: "top-left"
    });
	$('#pum1').on('change',function(){
		var a=$('#pum').val();
		var arr=a.split('-');
		
		
	});
	
$('#lp').on('click',function(){
    if($(this).prop("checked")){
    $("#npd").attr("style","display:none");
    $("#npdate").prop('required',false);
    }else{
    $("#npd").attr("style","display:block");
    $("#npdate").prop('required',true);
    }
});
</script>