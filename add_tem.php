<?php 
include("include/db.php");

if(isset($_POST["add"])){
    $ic=str_replace("-","",$_POST["s_ic"]);
    $select=mysqli_query($conn,"select * from student where REPLACE(ic,'-','')='".$ic."' and s_status='ACTIVE'");
    $s_ic=mysqli_fetch_array($select);

    $ver="select * from student_tem wehre s_id='$ic' AND date(s_date)='".date("Y-m-d")."'";
    $sttr_ver=mysqli_query($conn,$qry);
    $num=mysqli_num_rows($sttr_ver);
    $qry="INSERT INTO `student_tem`(`s_id`, `phone_number`,`course`, `tem`, `s_date`) VALUES ('$s_ic[id]','$_POST[p_num]','$s_ic[course]','$_POST[tem]','".date('Y-m-d H:i:s')."')";

        if($sttr=mysqli_query($conn,$qry)){
            echo "<script>
                //alert('Submit success');
                window.location.href='student_temperature.php?action=msg_success_add'
            </script>";
        }else{
            echo "<script>
                alert('Submit fail');
                window.location.href='student_temperature.php?action=msg_fail_add'
            </script>";
        }
    
        echo "<script>
                alert('You already submited today');
                window.location.href='student_temperature.php?action=msg_fail_add'
            </script>";
    
    

}
if(isset($_POST["addstaff"])){
    $con=new mysqli("aster.arvixe.com","emirco1","emirco1","staff_leave");
    //$con=new mysqli("localhost","root","","staff_leave");
    $ic=str_replace("-","",$_POST["s_ic"]);
    $select=mysqli_query($con,"select * from user where REPLACE(u_ic,'-','')='".$ic."'");
    $s_ic=mysqli_fetch_array($select);
    echo $qry="INSERT INTO `staff_tem`(`s_id`, `phone_number`, `tem`, `s_date`) VALUES ('$s_ic[id]','$_POST[p_num]','$_POST[tem]','".date('Y-m-d H:i:s')."')";
    if($sttr=mysqli_query($con,$qry)){
        echo "<script>

            window.location.href='pp_temperature.php?action=msg_success_add'
        </script>";
    }else{
        echo "<script>
            alert('Submit fail');
           window.location.href='pp_temperature.php?action=msg_fail_add'
        </script>";
    }

}

if(isset($_POST["addvisitor"])){
    
    $qry="INSERT INTO `visitor_tem`(`s_id`, `phone_number`, `tem`, `s_date`) VALUES ('$_POST[s_name]','$_POST[p_num]','$_POST[tem]','".date('Y-m-d H:i:s')."')";
    if($sttr=mysqli_query($conn,$qry)){
        echo "<script>
            alert('Submit success');
            window.location.href='visitor_submit.php?action=msg_success_add'
        </script>";
    }else{
        echo "<script>
            alert('Submit fail');
            window.location.href='visitor_submit.php?action=msg_fail_add'
        </script>";
    }

}

if(isset($_GET["action"]) && $_GET["action"]=="delete"){
    $table=$_GET["table"];
    echo $qry="delete from $table where id='".$_GET["id"]."'";
    if($sttr=mysqli_query($conn,$qry)){
        echo "<script>
            window.location.href='student_soplist.php?action=msg_success_del'
        </script>";
    }else{
        echo "<script>
            window.location.href='student_soplist.php?action=msg_fail_del'
        </script>";
    }
}
?>