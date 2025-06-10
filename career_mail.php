<?php 
include("include/db.php");
if(isset($_POST["sendmail"])){
    require_once("PHPMailer/class.phpmailer.php");
    require_once("PHPMailer/function_user.php");

    $select="SELECT *, IF(e_gender='Male','Mr','Ms') as dear FROM career WHERE id='$_POST[eid]'";
    $sttr_se=mysqli_query($conn,$select);
    $result=mysqli_fetch_array($sttr_se);

    echo $dear=$result["dear"];
    

    $to=$_POST["email"];
    $to_name="Dear $dear ".$result["e_name"];
    $from="Synergy college HR";
    $subject="reply for career request";
    $message=nl2br($_POST["mail_content"]);

    $header="FROM: $_POST[email]";
    if(sendemail($to,$to_name,$from,$subject,$message,$header)){
        echo "<script>
        alert('send mail success');
        //window.location.href='career_list.php'
        </script>";
    }else{
        echo "<script>
        alert('send mail fail, please try again');
        //window.location.href='career_list.php'
        </script>";
    }
}
?>