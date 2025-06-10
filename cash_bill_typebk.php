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
		<option value="Debtor PTPK" <?php if(isset($_POST['cbo']) && $_POST['cbo'] == 'Debtor PTPK'){ echo 'selected';}?>>Debtor PTPK</option>
		<option value="Debtor" <?php if(isset($_POST['cbo']) && $_POST['cbo'] == 'Debtor'){ echo 'selected';}?>>Debtor</option>
		<option value="Internal Exam Fee" <?php if(isset($_POST['cbo']) && $_POST['cbo'] == 'Internal Exam Fee'){ echo 'selected';}?>>Internal Exam Fee</option>
		<option value="Hostel Fee" <?php if(isset($_POST['cbo']) && $_POST['cbo'] == 'Hostel Fee'){ echo 'selected';}?>>Hostel Fee</option>
		<option value="Tuition Fee" <?php if(isset($_POST['cbo']) && $_POST['cbo'] == 'Tuition Fee'){ echo 'selected';}?>>Tuition Fee</option>
		<option value="Tuition PTPK" <?php if(isset($_POST['cbo']) && $_POST['cbo'] == 'Tuition PTPK'){ echo 'selected';}?>>Tuition PTPK</option>
	</select>
</div>

<?php	
	
}else{
	
}?>