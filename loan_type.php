<?php
require ('include/db.php');
  
//get the username  
$value = $_POST['value'];  

if($value != 'Penanguhan'){?>
    <input type="hidden" name="amount" value="">
    <input type="hidden" name="bdn" value="">
    <input type="hidden" name="bdd" value="">
<?php
	
}else{?>

<div class="form-group">
    <label>Amount</label>
    <input type="text" name="amount" class="form-control" >
</div>

<div class="form-group">
    <label>Bank Draf No</label>
    <input type="text" name="bdn" class="form-control" >
</div>
			
<div class="form-group">
    <label>Bank Draf Date</label>
    <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="sd" data-link-format="yyyy-mm-dd">
    <input class="form-control" size="16" type="text" value="" required >
    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
    <input type="hidden" name="bdd" id="sd" value="" />
</div>

<?php   }?>

    <script src="js/jquery.js"></script>
    
<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript">
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
</script>