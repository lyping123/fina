<?php 
include("include/db.php");

if(isset($_POST["add"])){
    $select_ic=mysqli_query($conn,"select id from student where ic='$_POST[s_ic]'");
    $row=mysqli_fetch_array($select_ic);
    $id=$row[0];
    $select="select * from token_code where s_id='$id' and tk_code='$_POST[tk_code]'";
    $ver_sttr=mysqli_query($conn,$select);
    $num=mysqli_num_rows($ver_sttr);

    if($num==1){
        $insert="insert into add_att(s_id,s_status,sign_in_date,sign_in_time) values('$id','ACTIVE','".date("Y-m-d")."','".date("h:i:s")."')";
        $sttr_insert=mysqli_query($conn,$insert);
        echo "<script>
            window.location.href='student_attadancescan.php?action=msg_success_add'
        </script>";
    }else{
        echo "<script>
            window.location.href='student_attadancescan.php?action=msg_fail_add'
        </script>";
    }

}

?>