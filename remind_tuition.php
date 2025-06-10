<?php 
include("include/db.php");

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);



$qry="SELECT s.id,s.s_name,s.s_email,s.tuition_fee,DATE_FORMAT(f.r_date, '%Y-%m') as ym,SUM(fd.rp_amount) as total_amount,fd.rp_desc,DATE_FORMAT(MAX(f.r_date), '%Y-%m-%d') as r_date,
    TIMESTAMPDIFF(MONTH,DATE(t_start),CURDATE()) as month_difference,s.month_pay FROM student s 
    INNER JOIN f_receipt f ON f.s_id=s.id
    INNER JOIN f_receipt_detail fd ON fd.r_id=f.id
    WHERE s.p_method='ptpk' AND s.s_status='ACTIVE' AND (cash_bill_option='Tuition Fee' OR cash_bill_option='Tuition PTPK Seft Pay') AND CURDATE() BETWEEN t_start AND t_end
    GROUP BY s.id,s.s_name";
    $sttr=mysqli_query($conn,$qry);
    $result=mysqli_num_rows($sttr);
    $status="selected";

    $message="Reminder for tuition fee payment: \n";
    
if($result>0){ 
    while($result=mysqli_fetch_array($sttr)){
        $datereceipt=new DateTime($result['r_date']);
        $dateafteronemonth=$datereceipt->modify('+1 month')->format("Y-m");
        $last_receiptdate=date_format($datereceipt,"Y-m");
        $month=$result["month_difference"]+2;
        $total_outstanding=$result["month_pay"]*$month-$result["total_amount"];
        $datenow=new DateTime(date("Y-m-d"));
        
        if($total_outstanding>0){ 
            $message.=$result["s_name"]."(RM $total_outstanding) \n";
        }
    }

    $message.="for more detail can check with this link: \n https://registration.synergycollege2u.com/check_outstanding1.php?bill_type=tuitionfee";
    
}


$phonenumbers=array('60129253398','60124346832','60164237177');

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