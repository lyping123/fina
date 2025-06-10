<?php
require ('include/db.php');
  
//get the username  
$value = $_POST['value'];  

if($value == '1'){?>
	<input type="hidden" name="p_type" value="Debtor">
<?php
	
}elseif($value == '2'){?>

<div class="form-group">
	<label>Payment Option</label>
	<select name="p_type" class="form-control" required>
		<option value="Debtor PTPK">Debtor PTPK</option>
		<option value="Debtor">Debtor</option>
		<option value="Internal Exam Fee">Internal Exam Fee</option>
		<option value="Hostel Fee">Hostel Fee</option>
		<option value="Tuition Fee">Tuition Fee</option>
		<option value="Tuition PTPK">Tuition PTPK</option>
	</select>
</div>

<?php	
	
}else{
	
}?>