<?php 
require('include/db.php');

$id = $_POST['id'];  
$option = '';
$result = mysqli_query($conn,"SELECT * FROM student WHERE id = '".$id."'"); 
$row = mysqli_fetch_array($result);

echo $row['ic'].",".$row["hp_contact"].",".$row["course"];
?>