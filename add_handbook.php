<?php 
include("include/db.php");
if(isset($_POST["submit"])){
    $qry="insert into agreement(s_id,sign,read_status,a_type) values('$_POST[id]','','$_POST[ck]','handbook')";
    if($sttr=mysqli_query($conn,$qry)){
        echo "<script>
        alert('Handbook agreement sign success');
        window.location.href='handbook.php'
        </script>";
    }else{
        echo "<script>
        alert('Handbook agreement sign fail');
        window.location.href='handbook.php'
        </script>";
    }
}

?>