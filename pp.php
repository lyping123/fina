<?php
require('include/db.php');

if(!empty($_POST['value'])){
	$value = " AND c_id = '".$_POST['value']."'";
}else{
	$value = '';
}

$c_qry = "SELECT * FROM login WHERE level = 'pp' AND l_status = 'ACTIVE'".$value;
$c_result = mysqli_query($conn,$c_qry);
while($c_row = mysqli_fetch_array($c_result)){
	echo "<option value='$c_row[id]'>$c_row[l_name]</option>";
}
?>