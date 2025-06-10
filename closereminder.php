<?php 
include("include/db.php");
if(isset($_GET["id"])){
    $qry="update reminder set g_status='CLOSE' where id='".$_GET["id"]."'";
    if($sttr=mysqli_query($conn,$qry)){
        echo "<script>
            alert('Reminder have been shut down success');
            window.location.href='group_list.php'
        </script>";
    }else{
        echo "<script>
            alert('Reminder have been shut down fail');
            window.location.href='group_list.php'
        </script>";
    }
    

}

?>