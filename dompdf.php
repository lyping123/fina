<?php
require('include/db.php');
require __DIR__ . '/../vendor/autoload.php';


use Dompdf\Dompdf;
use Dompdf\Options;

// Fetch receipt data
$id = $_GET['id'] ?? null;
$qry = "SELECT *, r.s_name AS old_name, r.r_date as newdate, r.createby as newid 
        FROM f_receipt AS r
        LEFT JOIN f_b_c AS bc ON bc.r_id = r.id 
        LEFT JOIN student AS s ON s.id = r.s_id
        WHERE r.id = '".mysqli_real_escape_string($conn, $id)."'";
$sql = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($sql);

// Compute receipt no.
$type = '';
if ($row['receipt_type'] == 2) {
    switch ($row['cash_bill_option']) {
        case 'Debtor PTPK': $type = 'DP'; break;
        case 'Debtor': $type = 'D'; break;
        case 'Internal Exam Fee': $type = 'I'; break;
        case 'Hostel Fee': $type = 'H'; break;
        case 'Tuition Fee': $type = 'T'; break;
        case 'Tuition PTPK': $type = 'TP'; break;
        case 'Tuition PTPK Auto debit': $type = 'TPA'; break;
        case 'Tuition PTPK Seft pay': $type = 'TPS'; break;
        case 'Enrollment Fee': $type = 'E'; break;
        case 'laptop deposit': $type = 'LD'; break;
    }
    $r_no = $row['r_no'] ?: $type.(10000 + mysqli_fetch_array(
        mysqli_query($conn, "SELECT count(id) AS r_no FROM f_receipt 
                             WHERE r_status='ACTIVE' AND receipt_type='".$row['receipt_type']."' 
                             AND cash_bill_option='".$row['cash_bill_option']."' 
                             AND id BETWEEN 1 AND ".$id)
    )['r_no']);
} else {
    $r_no = $row['r_no'] ?: 'D'.(10000 + mysqli_fetch_array(
        mysqli_query($conn, "SELECT count(id) AS r_no FROM f_receipt 
                             WHERE r_status='ACTIVE' AND receipt_type='".$row['receipt_type']."' 
                             AND cash_bill_option='".$row['cash_bill_option']."' 
                             AND id BETWEEN 1 AND ".$id)
    )['r_no']);
}

// Capture HTML
ob_start();
include __DIR__ . "/generate_receiptpdf.php"; // make sure this file has clean HTML+inline CSS
$html = ob_get_clean();

// Setup Dompdf
$options = new Options();
$options->set('isRemoteEnabled', true); // allow logo, Google fonts
$dompdf = new Dompdf($options);

// Render PDF
$dompdf->loadHtml($html);
$dompdf->setPaper("A4", "portrait");
$dompdf->render();

// Stream to browser
$filename = $r_no . " " . $row['s_name'] . ".pdf";
$dompdf->stream($filename, ["Attachment" => true]); // auto-download

