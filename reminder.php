<?php 
include("include/db.php");

require_once('/PHPMailer/class.phpmailer.php');
require_once('/PHPMailer/function_user.php');
$qry="select * from student_group where g_status='ACTIVE' and (g_level=4 or g_level='Single Tier')";
$sttr=mysqli_query($conn,$qry); 
while($row=mysqli_fetch_array($sttr)){
    $startdate = date("d-m-Y", strtotime($row["start_date"]));
    $enddate=date("d-m-Y",strtotime($row["end_date"]));
    $newDate = strtotime($row["start_date"]);
    $date_now=date("Y-m-d");
    $sec_t=strtotime(date('d-m-Y'));
    
    $g_select="select sgl.*, s.s_name, s.ic from student_group_list as sgl inner join student as s on s.id=sgl.s_id where sgl.g_id='".$row[0]."' and sgl.status='ACTIVE'";
    $g_sttr=mysqli_query($conn,$g_select);
    $member="";
    while($g_row=mysqli_fetch_array($g_sttr)){
        $member.="Name: ".$g_row["s_name"]."  IC: ".$g_row["ic"]."\r\n";
    }
    
//31536000 1 year
//604800 358 days

    // $split1=explode("-",$newDate);
    // $split2=explode("-",$sec_t);
    // $total_d=$split1[0]-$split2[0];
    // $total_m=$split1[1]-$split2[1];
    // $total_y=$split1[2]-$split2[2];
    //$newEndingDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($StaringDate)) . " + 365 day"));
    $qry1="select * from reminder where g_id='".$row[0]."' and date_remind='".$date_now."' and g_status='ACTIVE'";
    $sttr1=mysqli_query($conn,$qry1);
    $rows=mysqli_num_rows($sttr1);
    $row1=mysqli_fetch_array($sttr1);
    if($rows>=1){
    //$to = "lyping0526@gmail.com";
    $to=array("sysynergy@hotmail.com","ct_220992@yahoo.com","lyping0526@gmail.com");
    
	//$to = "gvta_25@yahoo.com.my";
	    $to_name = "Synergy Admin";
	    $from_name = "Reminder: PTPK-Bayaran Susulan";
	    $subject = "PTPK-Bayaran Susulan";
	    $message = nl2br("Group Name: $row[g_name] \r\n
                      Team member:\r\n $member
                      
                      <a href='http://registration.synergy-college.org/closereminder.php?id=$row1[0]'>close the reminder</a>
					  Start Date: $startdate \r\n
					  End Date: $enddate \r\n");
			
        $header = "From: reminder system";
        foreach($to as $email){
            $send=sendEmail($email,$to_name,$from_name,$subject,$message,$header);
        }
        
    
    }
    
        
}
?>