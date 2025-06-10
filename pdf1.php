<?php

//include connection file
include("connection.php");
//include('libs/fpdf.php');
include('mc_table1.php');
$batch = $_GET['batch'];

 

// Page header











 
$db = new dbObj();
$connString =  $db->getConnstring();


$query = "SELECT * FROM `parcel_send` WHERE `batch_id` = '$batch'";
$result_query = mysqli_query($connString,$query);

$display_heading = array('tracking_no'=>'Tracking no', 'c_name'=> 'Customer Name', 'c_address'=> 'Address','item_description'=> 'Item',);
$results = mysqli_query($connString, "CREATE TEMPORARY TABLE temp_table AS SELECT tracking_no, c_name, c_address, item_description FROM c_order") or die("database error:". mysqli_error($connString));
$header = mysqli_query($connString, "SHOW columns FROM temp_table");


while($data = mysqli_fetch_array($result_query)){

$row = $data['tracking_no'];
    
    $show = "SELECT tracking_no, c_name, c_phone, c_city, c_postcode, c_address, item_description FROM c_order WHERE tracking_no = '$row' ";
    $result = mysqli_query($connString,$show);
    $detail = mysqli_fetch_array($result);
    
     $check = "SELECT `batch_id` FROM `arrange` WHERE `batch_id` = $batch";
    $check_result =mysqli_query($connString,$check);
    if(mysqli_num_rows($check_result)==0){
    
//  $insert_q = "INSERT INTO `arrange` (`tracking_no`,`c_name`,`c_phone`,`c_city`,`c_postcode`,`c_address`,`item_description`,`batch_id`) VALUES ('".$detail[0]."','".$detail[1]."','".$detail[2]."','".$detail[3]."','".$detail[4]."','".$detail[5]."','".$detail[6]."','".$batch."')";
    
//      $results = mysqli_query($connString,$insert_q);
//     $details = mysqli_fetch_array($result);
    }elseif(mysqli_num_rows($check_result)==1){
        
    }

}






$pdf = new PDF('L');
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
// $pdf->SetY(70);
$pdf->SetFont('Arial','B',8);

$width_cell=array(20,25,15,15,15,40,55,8);

$pdf->Cell($width_cell[7],6,'No',1,0); // First header column 
$pdf->Cell($width_cell[0],6,'Tracking No',1,0); // First header column 
$pdf->Cell($width_cell[1],6,'Customer Name',1,0); // Second header column
$pdf->Cell($width_cell[2],6,'Phone No',1,0); // Third header column 
$pdf->Cell($width_cell[3],6,'City',1,0); // Fourth header column
$pdf->Cell($width_cell[4],6,'Postcode',1,0); // Fourth header column
$pdf->Cell($width_cell[5],6,'Address',1,0); // Fourth header column
$pdf->Cell($width_cell[6],6,'Item',1,0); // Fourth header column



//foreach($header as $heading) {
//$pdf->Cell(45,8,$display_heading[$heading['Field']],1);
//}
$pdf->Ln();



//function GenerateWord()
//{
//    //Get a random word
//    $nb=rand(3,10);
//    $w='';
//    for($i=1;$i<=$nb;$i++)
//        $w.=chr(rand(ord('a'),ord('z')));
//    return $w;
//}
//
//function GenerateSentence()
//{
//    //Get a random sentence
//    $nb=rand(1,10);
//    $s='';
//    for($i=1;$i<=$nb;$i++)
//        $s.=GenerateWord().' ';
//    return substr($s,0,-1);
//}
//echo GenerateSentence();
$pdf->SetWidths(array(8,20,25,15,15,15,40,55));
$count = 0;

$select = "SELECT tracking_no, c_name, c_phone, c_city, c_postcode, c_address, item_description FROM `arrange` WHERE `batch_id` = '$batch' AND `color` = '1' ORDER BY `c_city` ";
     $resultss = mysqli_query($connString,$select);
  while($detailss = mysqli_fetch_array($resultss)){
      $count++;
      $pdf->Row(array($count,$detailss[0],$detailss[1],$detailss[2],$detailss[3],$detailss[4],$detailss[5],$detailss[6]));
  }

  
$pdf->Output();
?>
