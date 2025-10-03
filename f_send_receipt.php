<?php
include("include/db.php");
require_once('phpmailer.php');

$qry = "SELECT *,r.s_name AS old_name,r.r_date as newdate,r.createby as newid FROM f_receipt AS r
		LEFT JOIN f_b_c AS bc ON bc.r_id = r.id 
		LEFT JOIN student AS s ON s.id = r.s_id
		WHERE r.id = '".$_GET['id']."'";
$sql = mysqli_query($conn,$qry);
$row = mysqli_fetch_array($sql);
$num = mysqli_num_rows($sql);

if($row['receipt_type'] == 2){
                            if($row['cash_bill_option'] == 'Debtor PTPK'){
                                $type = 'DP';
                            }elseif($row['cash_bill_option'] == 'Debtor'){
                                $type = 'D';
                            }elseif($row['cash_bill_option'] == 'Internal Exam Fee'){
                                $type = 'I';
                            }elseif($row['cash_bill_option'] == 'Hostel Fee'){
                                $type = 'H';
                            }elseif($row['cash_bill_option'] == 'Tuition Fee'){
                                $type = 'T';
                            }elseif($row['cash_bill_option'] == 'Tuition PTPK'){
                                $type = 'TP';
                            }elseif($row['cash_bill_option'] == 'Tuition PTPK Auto debit'){
                                $type = 'TPA';
                            }elseif($row['cash_bill_option'] == 'Tuition PTPK Self pay'){
                                $type = 'TPS';
                            }
                            elseif($row['cash_bill_option'] == 'Enrollment Fee'){
                                $type = 'E';
                            }
                            elseif($row['cash_bill_option'] == 'laptop deposit'){
                                $type = 'LD';
                            }

                            if($row['r_no'] == ''){
                                $rno_qry = "SELECT count(fr.id) AS r_no FROM f_receipt AS fr WHERE fr.r_status = 'ACTIVE' AND fr.receipt_type = '".$row['receipt_type']."' AND fr.cash_bill_option = '".$row['cash_bill_option']."' AND fr.id BETWEEN 1 AND ".$_GET['id'];
                                $rno_result = mysqli_query($conn, $rno_qry);
                                $rno_row = mysqli_fetch_array($rno_result);
                                $r_no = 10000 + $rno_row['r_no'];
                                $r_no = $type.$r_no;
                            }else{
                                $r_no = $row['r_no'];
                            }
                        }else{
                            if($row['r_no'] == ''){
                                $rno_qry = "SELECT count(fr.id) AS r_no FROM f_receipt AS fr WHERE fr.r_status = 'ACTIVE' AND fr.receipt_type = '".$row['receipt_type']."' AND fr.cash_bill_option = '".$row['cash_bill_option']."' AND fr.id BETWEEN 1 AND ".$_GET['id'];
                                $rno_result = mysqli_query($conn, $rno_qry);
                                $rno_row = mysqli_fetch_array($rno_result);
                                $r_no = 10000 + $rno_row['r_no'];
                                $r_no = 'D'.$r_no;
                            }else{
                                $r_no = $row['r_no'];
                            }
                        }

$email=$row["s_email"];
// $email="lyping0526@gmail.com";

// <a href='https://registration.synergycollege2u.com/dompdf.php?id=$_GET[id]'
$result = sendReceiptMail(
    $email,                // student's email
    $row['s_name'],                 // student's name
    "Your Receipt " . $r_no,        // subject
    "<p>Kindly click the link to login in to student portal to download the receipt.</p>
    <br>
    <a href='https://registration.synergycollege2u.com/student_login?page=receipt'>CLick here</a>", // body
    
    $pdfContent,
    $pdfFilename
);

if ($result === true) {
    echo "<script>
    alert('Receipt mail successful');
    window.location.href='f_choose1.php?id=$_GET[id]'
    </script>";
} else {
    echo "<script>
    alert('Receipt mail fail, please try again later');
    window.location.href='f_choose1.php?id=$_GET[id]'
    </script>";
}


?>