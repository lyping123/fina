<?php 
include('include/db.php');
$value=$_POST['value'];
if($value!==""){
	$query="select * from student where id='".$value."'";
	$sttr=mysqli_query($conn,$query);
	$result=mysqli_fetch_array($sttr);
	echo $result['course'];
}
else{
		
}


?>