<?php 
include("include/db.php");
require_once 'phpexcel/Classes/PHPExcel.php';
require_once 'phpexcel/Classes/PHPExcel/IOFactory.php';

$objPHPExcel = new PHPExcel();
$objSheet = $objPHPExcel->getActiveSheet();

// $qry="SELECT *,f.id as newid1,fr.id as newid2 FROM `f_receipt` as f
// INNER JOIN f_receipt_detail as fr on fr.r_id=f.id
// WHERE f.id BETWEEN 12762 AND 12788 AND f.cash_bill_option='Tuition Fee' AND f.r_status='ACTIVE'";
$qry="SELECT *,f.id as newid1,fr.id as newid2 FROM `f_receipt` as f
INNER JOIN f_receipt_detail as fr on fr.r_id=f.id
WHERE f.id BETWEEN 14941 AND 15024 AND f.cash_bill_option='Tuition PTPK' AND f.r_status='ACTIVE'";
$sttr=mysqli_query($conn,$qry);

$objSheet->getCell(chr("65").'1')->setValue("ID");
$objSheet->getCell(chr("66").'1')->setValue("r_date");
$objSheet->getCell(chr("67").'1')->setValue("s_id");
$objSheet->getCell(chr("68").'1')->setValue("detail id");
$objSheet->getCell(chr("69").'1')->setValue("r_id detail");
$objSheet->getCell(chr("70").'1')->setValue("describetion");
$objSheet->getCell(chr("71").'1')->setValue("amonth");
$i=2;
$no=1;
while($row=mysqli_fetch_array($sttr)){
    $objSheet->getCell(chr("65").$i)->setValue($row["newid1"]);
    $objSheet->getCell(chr("66").$i)->setValue($row["r_date"]);
    $objSheet->getCell(chr("67").$i)->setValue($row["s_id"]);
    $objSheet->getCell(chr("68").$i)->setValue($row["newid2"]);
    $objSheet->getCell(chr("69").$i)->setValue($row["r_id"]);
    $objSheet->getCell(chr("70").$i)->setValue($row["rp_desc"]);
    $objSheet->getCell(chr("71").$i)->setValue($row["rp_amount"]);
    $i++;
    $no++;
}


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="execl_data.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

?>