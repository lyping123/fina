<?php 

require_once('PHPMailer/class.phpmailer.php');
require_once('PHPMailer/function_user.php');


	$to="lyping0526@gmail.com";
	$to_name = "Synergy Admin";
			$from_name = "Reminder: PTPK-Bayaran Susulan";
			$subject = "PTPK-Bayaran Susulan";
			$message = nl2br("Group Name: $row[g_name] \r\n
						  Team member:\r\n $member
						  
						  <a href='./closereminder.php?id=$row1[0]'>close the reminder</a>
						  Start Date: $startdate \r\n
						  End Date: $enddate \r\n");
				
			$header = "From: reminder system";
	
	$send=sendEmail($to,$to_name,$from_name,$subject,$message,$header);	

?>
