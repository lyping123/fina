<?php 
include("include/db.php");


$sql="select * from student where s_status='ACTIVE'";
$sttr=mysqli_query($conn,$sql);
$array=array();
function generateRandomString($length = 6) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
while($row=mysqli_fetch_array($sttr)){
    $random_str=generateRandomString();
    $array[]="('$row[id]','$random_str')";    
}
$new_sql=implode(",",$array);

$delete=mysqli_query($conn,"delete from token_code");

$insert="insert into token_code(s_id,tk_code) values".$new_sql;
$sttr_insert=mysqli_query($conn,$insert);

?>