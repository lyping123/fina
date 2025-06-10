<?php 
$conn=new mysqli("aster.arvixe.com","emirco1","emirco1","student_registration");
//467,475,385,374,389,388,382,383,536,572,489,464,477,519,494,492,481,490,493,460,463
$array=array(467,475,385,374,389,388,382,383,536,572,489,464,477,519,494,492,481,490,493,460,463);
$sql=implode(",",$array);
//error_reporting(E_ALL);

require_once '/phpexcel/Classes/PHPExcel/IOFactory.php';
require_once '/phpexcel/Classes/PHPExcel.php';

//$excel2 = PHPExcel_IOFactory::createReader('Excel2007');

//$excel2 = $excel2->load('Attendance 2020 PROGRAMMING.xlsx');

//$excel2->setActiveSheetIndex(2);
$objPHPExcel = new PHPExcel();
$objWorkSheet=$objPHPExcel->getActiveSheet();

$select="select * from student where id IN(".$sql.") order by s_name";
$sttr=mysqli_query($conn,$select);

$num=1;
while($row=mysqli_fetch_array($sttr)){
    $chr=66;
    $objWorkSheet->getCell(chr(65).$num)->setValue($row["s_name"]);
    for($i=0;$i<7;$i++){
        $in_1_t = mt_rand(mktime(8,40),mktime(9,10));
        $in_2_t = mt_rand(mktime(12,15),mktime(13,10));

        if($row[0]==388 || $row[0]==489 || $row[0]==464 || $row[0]==477 || $row[0]==467){
            $in_2_t = mt_rand(mktime(12,00),mktime(12,00));
        }
        $timein=date("h:i",$in_1_t);
        $timeout=date("h:i",$in_2_t);
        
        $objWorkSheet->getCell(chr($chr).$num)->setValue($timein);
        $chr++;
        $objWorkSheet->getCell(chr($chr).$num)->setValue($timeout);
        $chr++;
    }
    $num++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="testing.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');






?>



