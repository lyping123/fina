<?php 
require ('include/db.php');
$value=$_POST['value'];

if($value=="Hostel Fee"){
	

?>
<div class="form-group">
                                    <label>Start Date</label>
                                    <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="pd" data-link-format="dd-mm-yyyy">
                                        <input class="form-control" size="16" type="text" placeholder="Payment Date" value="" required="required">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <input type="hidden" name="pd" id="pd" value=""/>
                                </div>
                                <div class="form-group">
                                    <label>End Month</label>
                                    <div class="input-group date form_month" data-date="" data-date-format="mm-yyyy" id="pum1" data-link-field="pum" data-link-format="mm-yyyy">
                                        <input class="form-control" size="16" type="text" placeholder="Pay Until Month" value="" required="required">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <input type="hidden" name="pum" id="pum" value=""/>
                                </div>
                                <div class="form-group">
                                	<input type="checkbox" name="l_payment"> Last Payment
								</div>
                                <div class="form-group">
                                    <label>Next Payment Date</label>
                                    <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="npd1" data-link-format="dd-mm-yyyy">
                                        <input class="form-control" size="16" type="text" placeholder="Next Payment Date" value="" required="required">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <input type="hidden" name="npd" id="npd1" value=""/>
                                </div><?php }else{};?>
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
</script>

								