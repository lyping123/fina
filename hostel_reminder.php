<?php 
include("include/db.php");
require_once('PHPMailer/class.phpmailer.php');
require_once('PHPMailer/function_user.php');

$qry="SELECT MAX(d.next_payment) as next_payment,s.s_email,s.s_name,DATEDIFF(MAX(d.next_payment),'".date("Y-m-d")."') as day FROM `duration` as d 
INNER JOIN student as s on s.id=d.studentid
WHERE status='ACTIVE' GROUP BY d.studentid order by d.id DESC";
$sttr=mysqli_query($conn,$qry);
$student=array();
$date="";
while($result=mysqli_fetch_array($sttr)){
    
    
	//$to = "gvta_25@yahoo.com.my";
    if($result["day"]<=-7 && !empty($result["day"])){
        $to=$result["s_email"];
        $student[]=$result["s_name"];
        // echo "<br>";
        //$to="lyping0526@gmail.com";
	    $to_name = $result["s_name"];
	    $from_name = "Reminder: Hostel Fee";
	    $subject = "Hostel Fee Payment";
	    $message = nl2br("Your hostel Fee Duration is ended at $result[next_payment], Please visit Admin office  to pay your hostel Fee");
			
        $header = "From: reminder system";
        
        //$send=sendEmail($to,$to_name,$from_name,$subject,$message,$header);
        $date=$result["next_payment"];
    }
    
}

$to=array("sysynergy@hotmail.com","ct_220992@yahoo.com","lyping0526@gmail.com");
foreach($to as $email){
    $to_name = "Synergy Admin";
	$from_name = "Reminder: Hostel Fee";
	$subject = "Hostel Fee Payment";
    $newname=implode("<br>",$student);
	$message = nl2br("Here is the following student which have none paying hostel fee yet at due date:<span style='color:red'>$date</span>
    <br>
    Student List
    <hr>
    $newname
    ");		
    $header = "From: reminder system";
}

?>