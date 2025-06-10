<?php 
include("include/db.php");

if(isset($_GET["q"]) && $_GET["q"]!==""){
    $qry="select * from customer_bill where id='".$_GET["q"]."'";
    $sttr=mysqli_query($conn,$qry);
    $result=mysqli_fetch_array($sttr);
    
    $myObj["id"] = $result["id"];
    $myObj["name"] = $result["s_name"];
    $myObj["ic"] = $result["ic"];
    $myObj["c_date"] = $result["date_create"];
    $myObj["p_type"]=$result["p_type"];
    $myObj["payment"]=$result["payment"];

    $myJSON = json_encode($myObj);

    echo $myJSON;
   
}

?>