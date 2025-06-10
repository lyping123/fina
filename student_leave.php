<?php 
require('include/db.php');

$id = $_POST['id'];  
$option = '';
$qry = "SELECT * FROM student AS u 
		LEFT JOIN student_leave AS sl ON sl.s_id = u.id
		WHERE u.id = '".$id."'";
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($result);

$qry1 = "SELECT *, SUM(a_days) AS total_apply FROM apply_leave_list WHERE s_id = '".$id."' AND a_leave_type = 'Leave' AND year(STR_TO_DATE(a_from, '%d-%m-%Y')) = '".YEAR."' AND a_status = 'APPROVAL'";
$result1 = mysqli_query($conn,$qry1);
$row1 = mysqli_fetch_array($result1);

$leave = $row['leave'] - $row1['total_apply'];

$myObj = array("ic"=>$row['ic'], "annual"=>$leave);

$myJSON = json_encode($myObj);

echo $myJSON;
?>