<?php 
include("include/db.php");

include('/phpexcel/Classes/PHPExcel.php');
include('/phpexcel/Classes/PHPExcel/IOFactory.php');


if(isset($_POST["add_excel"])){
    $date=date("d-m-Y h:m A");
	$target_dir = 'fingerPrint/';
	$target_file = $target_dir . basename($_FILES["filename"]["name"]);
	$filename=pathinfo($target_file,PATHINFO_FILENAME);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
    $newfilename=$target_dir.$filename.strtotime("now").".".$imageFileType;

    if($imageFileType!=='xlsx' && $imageFileType!=='xls' && $imageFileType!=='csv'){
        echo "<script>
        alert('Please make sure file type is xlsx, xls or csv')
        window.location.href='finger_print_list.php'
        </script>";
        break;
    }elseif(move_uploaded_file($_FILES["filename"]["tmp_name"],$newfilename)){
        $insert=mysqli_query($conn,"insert into finger_print_file(path,date)values('$newfilename','".date("d-m-Y h:i:s")."')");
        $last_id = mysqli_insert_id($conn);
    }else{
        echo "<script>
        alert('fail uploaded')
        window.location.href='finger_print_list.php'
        </script>";
        break;
    }
    

    //$target_file=$_FILES["filename"];
    $inputFileType = PHPExcel_IOFactory::identify($newfilename);
    $objReader = PHPExcel_IOFactory :: createReader($inputFileType);
    $objReader->setReadDataOnly(true);

    $objPHPExcel = PHPExcel_IOFactory::load($newfilename);
foreach($objPHPExcel->getWorksheetIterator() as $worksheet){
    $worksheetTitle     = $worksheet->getTitle();
    $highestRow         = $worksheet->getHighestRow(); // e.g. 10
    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $nrColumns = ord($highestColumn) - 64;
    $highestRow = $highestRow + 1;
    for ($row = 2; $row < $highestRow; ++ $row) {
        $filesop=array();
        for ($col = 0; $col < $highestColumnIndex; ++ $col) {
            $cell = $worksheet->getCellByColumnAndRow($col, $row);
            $filesop[] = $cell->getValue();
            
        }
        //$time=date("h:i s A",strtotime($filesop[2]));
        $imageFileType;
        
        if($imageFileType=="csv"){
            $time=$filesop[8];
            $date="";

        }else{
            $time= PHPExcel_Style_NumberFormat::toFormattedString($filesop[8], 'DD/MM/YYYY HH:i:s A');
            //$date= PHPExcel_Style_NumberFormat::toFormattedString($filesop[8], 'DD/MM/YYYY');
        }
        
        
        $sql[] = "('$filesop[2]','$filesop[3]','$time','ACTIVE','$last_id')";
        

        
    }
    

}
    $new_sql = implode(",",$sql);
    $qry2 = "insert into finger_print_attadance(uid,s_id,s_time,status,c_id) VALUES ".$new_sql;
    if($result2 = mysqli_query($conn,$qry2)){
        echo "<script>
        alert('successfully upload')
        window.location.href='finger_print_list.php'
        </script>";
    }else{
        echo "<script>
        alert('Fail to uploaded')
        window.location.href='finger_print_list.php'
        </script>";
    }
    

}
if(isset($_GET["action"])){
    $query="delete from finger_print_file where id='".$_GET["id"]."'";
     if($del=mysqli_query($conn,$query)){
         $update="update finger_print_attadance set status='DELETE' where c_id='".$_GET["id"]."'";
         $up_sttr=mysqli_query($conn,$update);

     }
     echo "<script>
     alert('delete success');
     window.location.href='finger_print_file.php'
     </script>";
 
 }

?>