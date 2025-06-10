<?php 
require('include/db.php');

$id = $_POST['id'];  
$option = '';
$result = mysqli_query($conn,"SELECT * FROM student WHERE id = '".$id."'"); 
$row = mysqli_fetch_array($result);
$ic=$row["ic"];
$course=$row["course"];

$array=array("ic"=>$ic,"course"=>$course);

echo json_encode($array)
?>