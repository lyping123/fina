<?php 
include("include/db.php");
if(isset($_POST["exam"])){
    $qry=mysqli_query($conn,"insert into certificate(cel_no,exam_date,certificate_date,level,s_id) values('".$_POST['no']."','".$_POST["exam"]."','".$_POST["cer"]."','".$_POST["level"]."','".$_POST["sid"]."')");
    echo "insert success";
}
if(isset($_POST["delete"])){
    $qry="delete from certificate where id='".$_POST['delete']."'";
    $sttr=mysqli_query($conn,$qry);
    echo "delete success";
}

?>