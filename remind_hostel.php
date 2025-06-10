<?php 
include("include/db.php");

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);






$qry="SELECT MIN(f.id),MIN(f.r_date) as r_date ,s.s_name,s.id as s_id,s.s_email FROM f_receipt f
INNER JOIN student s ON f.s_id=s.id
WHERE f.cash_bill_option='Hostel Fee' AND s.s_status='ACTIVE' AND s.h_status='YES'  GROUP BY f.s_id ORDER BY f.id ASC" ;
$sttr=mysqli_query($conn,$qry);
$result=mysqli_num_rows($sttr);


$message="";
if($result>0){
    while($row=mysqli_fetch_array($sttr)){
        $r_date=$row["r_date"];
        $date=new DateTime($r_date);

        $currentdatetime= new DateTime();
        $interval=$date->diff($currentdatetime);
        $total_months = $interval->y * 12 + $interval->m;
        $periods_of_six_months = ceil($total_months / 6);
        $qry2="SELECT rp_amount FROM f_receipt_detail WHERE r_id=$row[0]";

        $sttr2=mysqli_query($conn,$qry2);
        $row2=mysqli_fetch_array($sttr2);
        $paid_amount=$row2["rp_amount"];

        $total_shouldpaid=$periods_of_six_months*$paid_amount;

        $qry1="SELECT SUM(fd.rp_amount) as total,DATE_FORMAT(MAX(f.r_date),'%Y-%m-%d') as latest_date FROM f_receipt f
        INNER JOIN f_receipt_detail as fd on fd.r_id=f.id
        WHERE f.cash_bill_option='Hostel Fee' AND f.s_id='$row[s_id]'";
        $sttr1=mysqli_query($conn,$qry1);
        $row1=mysqli_fetch_array($sttr1);
        $total=$row1["total"];
        $latest_date=$row1["latest_date"];
        $total_outstading=$total_shouldpaid-$total;


        $date=new DateTime($latest_date);
        $interval=$date->diff($currentdatetime);
        $latest_months = $interval->y * 12 + $interval->m;
        
        
        $date->modify("+$periods_of_six_months month");
        $expiry_date=$date->format('Y-m-d');
        
        $newexpiry_date=new DateTime($expiry_date);
        $newexpiry_date->modify("-7 day");
        $remind_date=$newexpiry_date->format('Y-m-d');


        $datenow=new DateTime(date('Y-m-d'));
        $daysleft=$newexpiry_date->diff($datenow)->format('%a');
        $dateex=new DateTime("2023-12-01");

        if($total_outstading>0 && $total_outstading<2000 && $newexpiry_date>$dateex){

            //$send=sendEmail($to,$to_name,$from_name,$subject,$message,$header);

            //$message.=$row["s_name"]." has not paid their hostel fee yet \n expiry date: $expiry_date, total outstading: RM $total_outstading,latest receipt date: $latest_date \r\n";
            $message.="Reminder for Hostel fee payment: \n";
            $message.=$row["s_name"]."(RM $total_outstading) \n";
        }

        
        
    }
    $message.="for more detail can check with this link: \n https://registration.synergycollege2u.com/check_outstandinghostel.php";
    
    
}

$phonenumbers=array('60129253398');

if($message!==""){
    foreach($phonenumbers as $phone){
        $curl = curl_init();
        $data = [
            'phone_number' => $phone,
            'message' =>$message,
        ];
    
    
    
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://onsend.io/api/v1/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => [
            'Accept: application/json',
            'Authorization: Bearer 9833f781d83d655faa80faccfd13b5279d29540ca3c0da84325068c6c5c73eca',
            'Content-Type: application/json',
        ],
    ]);
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
        echo 'cURL Error #:' . $err;
    } else {
        echo $response;
    }
    
    }
}



?>