<?php 
include("include/db.php");
$qry="select id from student_group where  end_date>='2022/03/31' and start_date<='2022/03/31'";
$sttr=mysqli_query($conn,$qry);
$array=array();

while($row=mysqli_fetch_array($sttr)){
    $array[]=$row[0];
}
$newcor=implode(",",$array);

$select="select * from student_group_list where g_id in ($newcor)";
$sttr_se=mysqli_query($conn,$select);
$num=mysqli_num_rows($sttr_se);

require_once 'phpexcel/Classes/PHPExcel.php';
require_once 'phpexcel/Classes/PHPExcel/IOFactory.php';

$objPHPExcel = new PHPExcel();

$sheet=1;

$objSheet = $objPHPExcel->getActiveSheet();

$col=3;
//$objSheet->mergeCells("A1:C1");
$objSheet->getCell("A1")->setValue("Total Student:$num");
//$objSheet->mergeCells("A2:B2");
$objSheet->getCell("A2")->setValue("Student Name");

$objSheet->getCell("C2")->setValue("Course");

while($result=mysqli_fetch_array($sttr_se)){
    $qry_stu="select * from student where id='$result[s_id]'";
    $sttr_stu=mysqli_query($conn,$qry_stu);
    $row=mysqli_fetch_array($sttr_stu);
    $objSheet->mergeCells("A$col:B$col");

    $objSheet->getCell("A".$col)->setValue($row["s_name"]);
    $objSheet->getCell("C".$col)->setValue($row["course"]);
    $col++;
}


$objSheet->setTitle("Student List");
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Student number list(2021).xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

?> 