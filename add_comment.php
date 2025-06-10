<?php 
include("include/db.php");
if(isset($_POST["sub"])){
    $qry="update pre_registration set status='REJECT',comment='$_POST[comment]' ,rej_date='".date("Y-m-d H:i:s")."' where id='$_POST[sub]'";
    if($sttr=mysqli_query($conn,$qry)){
        echo "<script>
        alert('student is rejected');
        window.location.href='pre_register_list.php';
        </script>";
    }else{
        echo "<script>
        alert('rejected fail');
        window.location.href='pre_register_list.php';
        </script>";
    }
}

?>