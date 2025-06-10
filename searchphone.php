<?php 
include("include/db.php");
if(isset($_GET["q"]) && $_GET["q"]!=="" ){
    $ic=str_replace("-","",$_GET["q"]);
    $qry="select * from student where REPLACE(ic,'-','')='$ic' and s_status='ACTIVE'";

    $sttr=mysqli_query($conn,$qry);
    $result=mysqli_fetch_array($sttr);

    echo $result["hp_contact"];
}

if(isset($_GET["p"]) && $_GET["p"]!=="" ){
    $conn=new mysqli("aster.arvixe.com","emirco1","emirco1","staff_leave");
    $ic=str_replace("-","",$_GET["p"]);
    $qry="select * from user where REPLACE(u_ic,'-','')='$ic'";
    $sttr=mysqli_query($conn,$qry);
    $result=mysqli_fetch_array($sttr);

    echo $result["u_contact"];
}

?>