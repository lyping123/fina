<?php
require('include/db.php');
if(isset($_POST['submit']) && $_POST['submit'] == 'save'){
	foreach ($_POST['name'] as $data) {
        $value[] = "('".$data."','".$_POST['time']."')";
    }	
    $new_value = implode(',',$value);
    echo $qry = "INSERT INTO attendance_ic(Stu_ID, Date_Time) VALUES".$new_value;
    if($result = mysqli_query($conn, $qry)){
        echo "<script>
        window.location.href = 'take_attend.php?action=msg_success_add';
        </script>";
    }else{
        echo "<script>
        window.location.href = 'take_attend.php?action=msg_fail_add';
        </script>";
    }
}

?>
