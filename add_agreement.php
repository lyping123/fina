<?php 
include("include/db.php");
if(isset($_POST["submit"])){
    $qry="insert into agreement(s_id,sign,read_status,a_type) values('$_POST[id]','','$_POST[ck]','hostel')";
    if($sttr=mysqli_query($conn,$qry)){
        echo "<script>
        alert('Hostel agreement sign success');
        window.location.href='agreement.php'
        </script>";
    }else{
        echo "<script>
        alert('Hostel agreement sign fail');
        window.location.href='agreement.php'
        </script>";
    }
}

?>