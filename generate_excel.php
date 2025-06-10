<?php 
include("include/db.php");
require_once 'phpexcel/Classes/PHPExcel.php';
require_once 'phpexcel/Classes/PHPExcel/IOFactory.php';


$objPHPExcel = new PHPExcel();
$sheet=1;
$objSheet = $objPHPExcel->createSheet($sheet);
$i=1;

$date="";
if(isset($_POST["s_date"])){
    $date="AND (r_date>='2023-04-15' AND r_date<='2023-04-15')";
}

$qry="SELECT 
a.l_name,
f.id as newid,
f.id,f.createby,
f.pay_mtd,
f.receipt_type,
DATE(f.r_date) AS r_date,
IF(f.s_name <> '', f.s_name, s.s_name) AS s_name,
IF(f.s_ic <> '', f.s_ic, s.ic) AS s_ic,
GROUP_CONCAT(fr.rp_desc, '(RM ', fr.rp_amount, ')'
    SEPARATOR '<hr>') AS descriptionn,
SUM(fr.rp_amount) AS total_amount,
IF(f.r_no <> '',
    f.r_no,

        (SELECT 
                LPAD(COUNT(frrr.id) + 100000,
                            7,
                            CASE
                                WHEN f.cash_bill_option = 'Tuition Fee' THEN 'T'
                                WHEN f.cash_bill_option = 'Material' THEN 'M'
                                WHEN f.cash_bill_option = 'Other' THEN 'O'
                            END) AS r_no
            FROM
                f_receipt AS frrr
            WHERE
                frrr.r_status = 'ACTIVE'
                    AND frrr.receipt_type = f.receipt_type
                    AND frrr.cash_bill_option = f.cash_bill_option
                    AND frrr.id BETWEEN 1 AND f.id)) AS r_no
FROM
f_receipt AS f
    LEFT JOIN
student AS s ON s.id = f.s_id
    INNER JOIN
f_receipt_detail AS fr ON fr.r_id = f.id
INNER JOIN 
`login` as a on a.id=f.createby
WHERE
f.r_status = 'ACTIVE' $date
GROUP BY f.id
ORDER BY f.id ASC";
$sttr=mysqli_query($conn,$qry);

$objSheet->getCell(chr("65").'1')->setValue("Receipt No");
$objSheet->getCell(chr("66").'1')->setValue("Date");
$objSheet->getCell(chr("67").'1')->setValue("Student Name");
$objSheet->getCell(chr("68").'1')->setValue("ic");
//$objSheet->getCell(chr("69").'1')->setValue("Description");
$objSheet->getCell(chr("69").'1')->setValue("Amount(RM)");
$objSheet->getCell(chr("70").'1')->setValue("Create By");

$objSheet->getStyle("A1:G1")->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'D6DCE4'),
        ),
        'font'=>array(
            'bold' => true
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        ),
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            ),
        ),

    )
);

$array_id=array();
$rows=2;
while($result=mysqli_fetch_array($sttr)){
    $array_id[]=$result["newid"];
    $objSheet->getCell(chr("65").$rows)->setValue($result["r_no"]);
    $objSheet->getCell(chr("66").$rows)->setValue($result["r_date"]);
    $objSheet->getCell(chr("67").$rows)->setValue($result["s_name"]);
    $objSheet->getCell(chr("68").$rows)->setValue($result["s_ic"]);
    //$objSheet->getCell(chr("69").$rows)->setValue($result["descriptionn"]);
    $objSheet->getCell(chr("69").$rows)->setValue($result["total_amount"]);
    $objSheet->getCell(chr("70").$rows)->setValue($result["l_name"]);
    $rows++;
    
}
$objSheet->getStyle("A2:G".($rows-1))->applyFromArray(array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        ),
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    ),
    

));

$objSheet->setTitle("receipt list");

$gdImage = imagecreatefromjpeg('images/avatar-01-removebg-preview.png');
// Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
$objDrawing->setName('Sample image');$objDrawing->setDescription('Sample image');
$objDrawing->setImageResource($gdImage);
$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing->setHeight(150);

foreach($array_id as $id){
    $qry1="SELECT *,r.s_name AS old_name,r.r_date as receipt_date FROM f_receipt AS r
    LEFT JOIN student AS s ON s.id = r.s_id
    WHERE r.id = '$id'";

    $sql = mysqli_query($conn,$qry1);
    $row = mysqli_fetch_array($sql);
    $num = mysqli_num_rows($sql);
    if($row['cash_bill_option'] == 'Tuition Fee'){
        $type = 'T';
    }elseif($row['cash_bill_option'] == 'Other'){
        $type = 'O';
    }elseif($row['cash_bill_option'] == 'Material'){
        $type = 'M';
    }
    if($row['r_no'] == ''){

        $rno_qry = "SELECT count(fr.id) AS r_no FROM f_receipt AS fr WHERE fr.r_status = 'ACTIVE' AND fr.receipt_type = '".$row['receipt_type']."' AND fr.cash_bill_option = '".$row['cash_bill_option']."' AND fr.id BETWEEN 1 AND ".$row[0];
        $rno_result = mysqli_query($conn, $rno_qry);
        $rno_row = mysqli_fetch_array($rno_result);
        $r_no = 100000 + $rno_row['r_no'];
        $r_no = $type.$r_no;
    }else{
        $r_no = $row['r_no'];
    }
    $sheet++;
    $objSheet = $objPHPExcel->createSheet($sheet);
    $objDrawing->setCoordinates('A1');
    $objSheet->mergeCells("A1:C6");
    $qry_se="select * from f_receipt_detail where r_id='$id'";
    $sttr_se=mysqli_query($conn,$qry_se);
    

    $objSheet->mergeCells("F1:I1");
    $objSheet->getCell("F1")->setValue("Fantasy Art Center");
    $objSheet->mergeCells("F2:I2");
    $objSheet->getCell("F2")->setValue("No 17, Tingkat 1 Jalan Lembah permai 1,");
    $objSheet->mergeCells("F3:I3");
    $objSheet->getCell("F3")->setValue("Taman Lembah permai, 14000 Bukit Mertajam");
    $objSheet->mergeCells("F4:I4");
    $objSheet->getCell("F4")->setValue("Email :fantasyartsy.c@gmail.com");
    $objSheet->mergeCells("F5:I5");
    $objSheet->getCell("F5")->setValue("HP: 019-2081231 (003214795-K)");
    $objSheet->mergeCells("L1:M1");
    $objSheet->getCell("L1")->setValue("OFFICIAL RECEIPT");
    $objSheet->mergeCells("L2:M2");
    $objSheet->getCell("L2")->setValue("Invoice No:$r_no");
    $objSheet->mergeCells("L3:M3");
    $objSheet->getCell("L3")->setValue("Date: $row[receipt_date]");
    $objSheet->mergeCells("L4:M4");
    $objSheet->getCell("L4")->setValue("Pay By: CASH");
    $objSheet->mergeCells("L5:M5");
    $objSheet->getCell("L5")->setValue("Reference No");
    $objSheet->mergeCells("L6:M6");
    $objSheet->getCell("L6")->setValue("Good Sole Are not returnable");
    $objSheet->mergeCells("A7:L7");
    $objSheet->getCell("A7")->setValue("Customer:Alex");
    $objSheet->getCell("A8")->setValue("No.Code");
    $objSheet->mergeCells("A8:C8");
    $objSheet->getCell("D8")->setValue("Description");
    $objSheet->mergeCells("D8:I8");
    $objSheet->getCell("J8")->setValue("Qty");
    $objSheet->getCell("K8")->setValue("U/Price	");
    $objSheet->getCell("L8")->setValue("Disc");
    $objSheet->getCell("M8")->setValue("Total");
    $objSheet->getStyle("A8:M8")->applyFromArray(array(
        'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        ),
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '7FDBE7')
        ),
        'font' => array(
            'bold' => true
        ),
        

    ));
    $i=9;
    $t_amo=0;
    $discount=0;
    while($row_se=mysqli_fetch_array($sttr_se)){
        $objSheet->getCell("A".$i)->setValue("");
        $objSheet->mergeCells("A$i:C$i");
        $objSheet->getCell("D".$i)->setValue("$row_se[rp_desc]");
        $objSheet->mergeCells("D$i:I$i");
        $objSheet->getCell("J".$i)->setValue("$row_se[quan]");
        $objSheet->getCell("K".$i)->setValue("$row_se[rp_amount]");
        $objSheet->getCell("L".$i)->setValue("$row_se[discount]");
        $objSheet->getCell("M".$i)->setValue("$row_se[rp_amount]");
        $t_amo+=$row_se["rp_amount"];
        $discount+=$row_se["discount"];
        $i++;
    }
    $objSheet->getStyle("A14:M14")->applyFromArray(array(
        'borders' => array(
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        ),
    ));
    $objSheet->mergeCells("A15:B15");
    $objSheet->getStyle("A15")->applyFromArray(array(
        'font' => array(
            'bold' => true
        ),
    ));
    $objSheet->getStyle("F1")->applyFromArray(array(
        'font' => array(
            'bold' => true
        ),
    ));
    $objSheet->getStyle("L1")->applyFromArray(array(
        'font' => array(
            'bold' => true
        ),
    ));
    $objSheet->getCell("A15")->setValue("CHEAH WAN YI");
    $objSheet->mergeCells("D15:F15");
    $objSheet->getCell("D15")->setValue("Cash/Chequers Payable to:");
    $objSheet->mergeCells("D16:F16");
    $objSheet->getCell("D16")->setValue("Fantasy Art Center");
    $objSheet->mergeCells("D17:F17");
    $objSheet->getCell("D17")->setValue("Hong Leong Bank");
    $objSheet->mergeCells("D18:F18");
    $objSheet->getCell("D18")->setValue("2480010784");
    $objSheet->mergeCells("H17:I17");
    $objSheet->getCell("H17")->setValue("  ADMIN ");
    $objSheet->getStyle("H17:I17")->applyFromArray(array(
        'borders' => array(
            'bottom' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            ),
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        ),
    ));
    $objSheet->getStyle("H18:I18")->applyFromArray(array(
        'borders' => array(
            'top' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            ),
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        ),
    ));
    $objSheet->mergeCells("H18:I18");
    $objSheet->getCell("H18")->setValue("Issue By");
    $objSheet->getStyle("L16:M16")->applyFromArray(array(
        'borders' => array(
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE),
        ),
    ));
    $objSheet->getStyle("L17:M17")->applyFromArray(array(
        'borders' => array(
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        ),
    ));
    
    $objSheet->getCell("K15")->setValue("TOTAL(RM):");
    $objSheet->getCell("K16")->setValue("disc(%):");
    $objSheet->getCell("K17")->setValue("Net Total:");
    $objSheet->getCell("K18")->setValue("Payment:");
    $objSheet->getCell("K19")->setValue("Balance:");
    $netbalance=$t_amo-($t_amo/100*$discount);
    $objSheet->getStyle("M15:M17")->applyFromArray(array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        ),
    ));
    $objSheet->getCell("M15")->setValue($t_amo);
    $objSheet->getCell("M16")->setValue($discount);
    $objSheet->getCell("M17")->setValue("RM ".$netbalance);


    
    $objSheet->setTitle($r_no);

}




header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="tuition receipt List data.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

?>