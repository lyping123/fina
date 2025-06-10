<?php 
include("include/db.php");

if(isset($_GET["q"])){
    $qry="SELECT * FROM student_class WHERE s_id='$_GET[q]'";
    $sttr=mysqli_query($conn,$qry);
    $row=mysqli_num_rows($sttr);
    if($row>=1){
        echo "true";
    }else{
        echo "false";
    }
}


if(isset($_GET["r"])){
    $qry="SELECT * FROM student_result WHERE s_id='$_GET[r]' AND semester='$_GET[ses]'";
    $sttr=mysqli_query($conn,$qry);
    $row=mysqli_num_rows($sttr);
    if($row>=1){
        echo "true";
    }else{
        echo "false";
    }
}

if(isset($_GET["c"])){
    $qry="SELECT * FROM student_calendar WHERE s_id='$_GET[c]'";
    $sttr=mysqli_query($conn,$qry);
    $row=mysqli_num_rows($sttr);
    if($row>=1){
        echo "true";
    }else{
        echo "false";
    }
}


if(isset($_GET["i"])){
    $qry="SELECT * FROM student_internship WHERE s_id='$_GET[c]'";
    $sttr=mysqli_query($conn,$qry);
    $row=mysqli_num_rows($sttr);
    if($row>=1){
        echo "true";
    }else{
        echo "false";
    }
}
?>