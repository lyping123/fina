<?php
require_once 'phpexcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();

    $file = urldecode($_GET["file"]);
    $filepath =  $file;
    /*header('Content-Description: File Transfer');
    //header('Content-Type: application/octet-stream');
    
    header('Content-type: application/vnd.ms-excel');

    // It will be called file.xls
    header('Content-Disposition: attachment; filename="'.$file.'"');

    Write file to the browser
    $objWriter->save('php://output');
    /*header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    //readfile($file);
    $objwriter=PHPExcel_IOfactory||createWriter($objPHPExcel,"Excel2016");
    $objwriter->save("php://output");*/
    if(file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);
        exit;
        
    }


?>