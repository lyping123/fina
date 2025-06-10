<?php 
require('include/db.php');
if(isset($_POST['ppname'])){
    
    $c_qry = "SELECT distinct `name` FROM lawatan_ppl WHERE `name` like '%".$_POST["ppname"]."%'";
    $c_result = mysqli_query($conn,$c_qry);
    
    //$myobj=array();
    $data=array();
    while($c_row=mysqli_fetch_array($c_result)){
        $data[]=$c_row[0];
    }
    echo $myJSON = json_encode($data);
    
}

?>