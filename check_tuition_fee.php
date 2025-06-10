<?php 
include("include/db.php");

$query="select * from student where s_status='ACTIVE' and p_method<>'l_payment' and id='481'";
$sttr=mysqli_query($conn,$query);
$outstanding=0;
while($row=mysqli_fetch_array($sttr)){
	

	$p_month=$row['p_month'];
	$p_month+=1;
    $outstanding=$row['outstanding'];
    //$row['s_name']."=".$row['outstanding'];
	if($row['p_method']=="semester" && $p_month<0){
		$outstanding+=0;
	}
	elseif($row['p_method']=="semester" && $p_month==0){
		$p_month-=6;
		$outstanding+=$row['cost_per_month'];
	}
	else{
		$total=$row['month']-$row['month_pay'];
		if($total<=0){
			$outstanding+=0;
			$pay=0;
		}else{
			$outstanding+=$row['cost_per_month'];
			$pay=1;
		}
        
	}	
		//echo $row['s_name']."=".$outstanding."<br>";
        echo $qry="update student set p_month='".$p_month."',outstanding='".$outstanding."',month_pay=month_pay+".$pay." where id='".$row['id']."'";
		$result=mysqli_query($conn,$qry);
	
	
}


?>