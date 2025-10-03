<?php 
include('include/db.php');
if(isset($_POST["submit"])){
    $s_id=$_SESSION["id"];
    $complaint_title=$_POST["complaint_title"];
    $complaint=$_POST["complaint"];
    $date=date("Y-m-d H:i:s");

    $qry="INSERT INTO student_complaint(`s_id`,`complaint_title`,`complaint`,`complaint_status`,`date`) VALUES('$s_id','$complaint_title','$complaint','Pending','$date')";
    if($sttr=mysqli_query($conn,$qry)){
        echo "<script>alert('Complaint submitted successfully');window.location='student_complaint_form.php';</script>";
    }else{
        echo "<script>alert('Error occurred, please try again');window.location='student_complaint_form.php';</script>";
    }

}



if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM complaints WHERE id = '$id' AND student_id = '".$_SESSION['id']."'";
    mysqli_query($conn, $sql);
    echo "<script>alert('Complaint deleted successfully');window.location.href='student_complaint_from.php';</script>";
}

if(isset($_POST['submit_status'])){
    $complaint_id = $_POST['complaint_id'];
    $status = $_POST['status'];

    $sql = "UPDATE student_complaint SET complaint_status = '$status' WHERE id = '$complaint_id'";
    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Status updated successfully');window.location.href='complaint_tableform.php';</script>";
    } else {
        echo "<script>alert('Error updating status');window.location.href='complaint_tableform.php';</script>";
    }
}

?>