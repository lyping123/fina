<?php 
include("include/db.php");
require_once 'phpexcel/Classes/PHPExcel.php';
require_once 'phpexcel/Classes/PHPExcel/IOFactory.php';


$objPHPExcel = new PHPExcel();

$objSheet = $objPHPExcel->getActiveSheet();

$qry="select * from mou where c_id='5'";
$sttr=mysqli_query($conn,$qry);

$no=65;

$objSheet->getCell(chr(65).'1')->setValue("company name");
$objSheet->getCell(chr(66).'1')->setValue("company address");
$objSheet->getCell(chr(67).'1')->setValue("company tel");
$objSheet->getCell(chr(68).'1')->setValue("manager name");
$objSheet->getCell(chr(69).'1')->setValue("Position");
$objSheet->getCell(chr(70).'1')->setValue("manager phone");
$objSheet->getCell(chr(71).'1')->setValue("email");
$objSheet->getCell(chr(72).'1')->setValue("company link");
$row=2;
$chr=65;
while($result=mysqli_fetch_array($sttr)){
    
    $objSheet->getCell(chr(65).$row)->setValue($result["c_name"]);
    $objSheet->getCell(chr(66).$row)->setValue($result["c_address"]);
    $objSheet->getCell(chr(67).$row)->setValue($result["c_tel"]);
    $objSheet->getCell(chr(68).$row)->setValue($result["name"]);
    $objSheet->getCell(chr(69).$row)->setValue($result["position"]);
    $objSheet->getCell(chr(70).$row)->setValue($result["tel"]);
    $objSheet->getCell(chr(71).$row)->setValue($result["email"]);
    $objSheet->getCell(chr(72).$row)->setValue($result["link"]);
    $row+=2;
}
$objSheet->setTitle("company information");
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="company_list.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');




?>
