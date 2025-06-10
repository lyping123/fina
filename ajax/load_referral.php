<?php 

include("../include/db.php");
$qry="SELECT * FROM referral";
$sttr=mysqli_query($conn,$qry);

$array=array();
while($r = mysqli_fetch_assoc($sttr)) {
    $array[] = $r;
}

$json=json_encode($array);

echo '{"data"'.':'.$json.'}';

?>