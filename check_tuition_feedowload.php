<?php 
include("include/db.php");
echo $query="select * from student where s_status='ACTIVE' and p_month<>'l_payment'";
$sttr=mysqli_query($conn,$query);
while($row=mysqli_fetch_array($sttr)){
	$p_month=$row['p_month'];
	$p_month+=1;
	$outstanding=$row['outstanding'];
	if($row['p_method']=="semester" && $p_month<0){
		$outstanding+=0;
	}
	elseif($row['p_method']=="semester" && $p_month==0){
		$p_month-=6;
		$outstanding+=$row['cost_per_month'];
	}
	else{
		$outstanding+=$row['cost_per_month'];
	}
		
		
		 $qry="update student set p_month='".$p_month."',outstanding='".$outstanding."' where id='".$row['id']."'";
		$result=mysqli_query($conn,$qry);
	
	
}


?>