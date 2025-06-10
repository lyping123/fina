<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight request for complex requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}
include("include/db.php");

$qry="SELECT s.id,s.s_name,s.s_email,s.tuition_fee,DATE_FORMAT(f.r_date, '%Y-%m') as ym,SUM(fd.rp_amount) as total_amount,fd.rp_desc,DATE_FORMAT(MAX(f.r_date), '%Y-%m-%d') as r_date FROM student s 
    INNER JOIN f_receipt f ON f.s_id=s.id
    INNER JOIN f_receipt_detail fd ON fd.r_id=f.id
    WHERE s.p_method='ptpk' AND s.s_status='ACTIVE' AND cash_bill_option='Tuition Fee'
    GROUP BY s.id,s.s_name
    HAVING total_amount<2400";
$sttr=mysqli_query($conn,$qry);
$result=mysqli_num_rows($sttr);

$students=[];


while($result=mysqli_fetch_array($sttr)){
    $datereceipt=new DateTime($result['r_date']);
    $dateafteronemonth=$datereceipt->modify('+1 month')->format("Y-m");
    $last_receiptdate=date_format($datereceipt,"Y-m");
    $datenow=new DateTime(date("Y-m-d"));
    if($datenow>=$datereceipt){ 
       $myobject=new stdClass();
       $myobject->s_name=$result["s_name"];
       $myobject->total_amount=$result["total_amount"];
       $myobject->r_date=$result["r_date"];
       $myobject->remind_date=$dateafteronemonth;
    }
    $students[] = $myobject;

}



header('Content-Type: application/json');

$myJSON = json_encode($students);

echo $myJSON;

?>