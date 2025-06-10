<?php
require ('include/sinclude.php');
  
//get the username  
$lt = $_POST['value'];  
$id = $_POST['id'];  

$qry = "SELECT * FROM student AS u 
		INNER JOIN student_leave AS sl ON sl.s_id = u.id
		WHERE u.id = '".$id."'";
$result = mysqli_query($conn,$qry);
$row = mysqli_fetch_array($result);

$qry1 = "SELECT *, SUM(a_days) AS total_apply FROM apply_leave_list WHERE s_id = '".$id."' AND a_leave_type = '".$lt."' AND year(STR_TO_DATE(a_from, '%d-%m-%Y')) = '".YEAR."' AND a_status = 'APPROVAL'";
$result1 = mysqli_query($conn,$qry1);
$row1 = mysqli_fetch_array($result1);

if($lt == 'Leave'){
	$leave = $row['leave'] - $row1['total_apply'];
}

function is_decimal( $val )
{
    return is_numeric( $val ) && floor( $val ) != $val;
}

if(is_decimal($leave)){
	$new_leave = floor($leave);
}else{
	$new_leave = $leave;
}

if($lt != 'Leave'){
		echo '<option value="">Choose</option>';
	for($i = 1 ; $i <= 31; $i++){
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
}else{
		echo '<option value="">Choose</option>';
	for($i = 1 ; $i <= $new_leave; $i++){
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
}
?>