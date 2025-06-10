<?php 
include("../include/db.php");


$servername = "sv94.ifastnet.com";
$username = "synergyc";
$password = "synergy@central";
$database = "synergyc_synergyedu";
$conn = new mysqli($servername, $username, $password, $database);

$qry = "SELECT * FROM students WHERE `status`='ACTIVE' ORDER BY created_at DESC";
$array = array();
$result1 = mysqli_query($conn,$qry);

while($r = mysqli_fetch_assoc($result1)) {
    $array[] = $r;
}

$json=json_encode($array);

echo '{"data"'.':'.$json.'}';
?>