<?php
// database connenct
require('include/include.php');

// wanted data wanna to insert
$array = array("DAIICHI GAKUIN HIGH SCHOOL TAKAHAGI MAIN SCHOOL","INSTITUT PROFESIONAL ALOT SETAR","INT. INTERNATIONAL COLLEGE","JIT SIN INDEPENDENT HIGH SCHOOL","KAMPUNG KASTAM","PENANG FREE SCHOOL"
,"SM PHOR TAY (PERSENDIRIAN) PULAU PINANG","SM SIN MIN","SM VU YUAN SANDAKAN","SMJK (C) CHIA MIN","SMJK (C) HENG EE","SMJK CHO MIN"
,"SMJK CHUNG HWA CONFUCIAN","SMJK CHUNG HWA CONFUCIAN PULAU PINANG","SMJK JIT SIN","SMJK KEAT HWA II","SMJK KRIAN","SMJK PHOR TAY"
,"SMJK SIN MIN","SMJK TSUNG WAH","SMK AMAN JAYA","SMK AYER HITAM","SMK BAGAN JAYA","SMK BAKAR ARANG"
,"SMK BAKTI","SMK BANDAR","SMK BANDAR SUNGAI PETANI","SMK BANDAR TASEK MUTIARA","SMK BANGAN JAYA","SMK BERAPIT"
,"SMK BERAPIT PULAU PINANG","SMK BERTAM INDAH","SMK BUKIT MERTAJAM","SMK CHIO MIN","SMK CONVENT BUTTERWORTH","SMK DARUL RIDUAR"
,"SMK DATUK HAJI ABDUL KADIR","SMK DATUK HAJI ADBUL KADIR","SMK GURUN","SMK HAJI ZAINUL ABDIDIN","SMK HUA LIAN","SMK JALAN DAMAI"
,"SMK JALAN DAMAI PULAU PINANG","SMK KAMPONG KASTAM","SMK KEPALA BATAS","SMK KLIAN PAUH","SMK KRIAN","SMK KRIAN PARIT BUNTAR"
,"SMK KUALA KETIL","SMK KUALA KETIL KEDAH","SMK KUALA PERLIS","SMK MACHANG BUBUK","SMK MAK MANDIN","SMK MATANG"
,"SMK MENENGAH MAK MANDIN","SMK MUADZAM SHAH","SMK MUHIBAH","SMK MUHIBBAH","SMK PEKAN BARU","SMK PERAI"
,"SMK PERLIS","SMK PERMAI INDAH","SMK POKOK SENA","SMK SAMA GAGAH","SMK SEBERANG JAYA","SMK SEBERANG PERAK"
,"SMK SEREMBAN JAYA","SMK SIMPANG","SMK SIMPANG AMPAT","SMK SIMPANG EMPAT","SMK SIN MIN","SMK SRI KOTA"
,"SMK SRI PENANG","SMK ST MICHAEL","SMK ST THERESA (M)","SMK ST THERSA","SMK ST.THERESA","SMK SYED HASSAN"
,"SMK TAMAN PERWIRA","SMK TAMAN SEJAHTERA","SMK TANJONG PUTERI","SMK TELOK AIR TAWAR","SMK TOKAI","SMK TUN SABAN"
,"SMK TUNKU ABDUL AZIZ","SMK Tunku Abdul Rahman","SMK TUNKU ADBUL RAHMAN","SMK TUNKU ISMAIL","SMK TUNKU SOFIAH","SMK TUNKUN ABD. AZIZ"
,"SMK TUNKUN ISMAIL","SMK VALDOR","SMK YU YUAN","SMKDBS");

//search the data from database to making matching with $array
$qry_rcp = "SELECT name_school FROM school_list";
$result_rcp = mysqli_query($conn, $qry_rcp);
$c_row = mysqli_num_rows($result_rcp);
$array2 = array();

// call from database and insert into an array
for($a = 0 ; $a < $c_row ; $a++){
	$row = mysqli_fetch_assoc($result_rcp);
	$array2[]= $row ;
}

// testing data // 
// $array = array("SMK MAK MANDIN","INSTITUT PROFESIONAL ALOT SETAR","INT. INTERNATIONAL COLLEGE","JIT SIN INDEPENDENT HIGH SCHOOL","KAMPUNG KASTAM","PENANG FREE SCHOOL"
// ,"SM PHOR TAY (PERSENDIRIAN) PULAU PINANG","SMK MACHANG BUBUK","SM SIN MIN","SM VU YUAN SANDAKAN","SMJK (C) CHIA MIN","SMJK (C) HENG EE","SMJK CHO MIN");
// print_r($array2);

// $array and $val_a is want insert data
// $array2, $val_b and $v is from database 

// here start the looping for insert
$found = false;
foreach ($array as $key_a => $val_a) {
    $found = false;
    foreach ($array2 as $key_b => $val_b) {
    	foreach($val_b as $k => $v) {			
			if ($val_a == $v){
           		echo '<br>'. $val_a . '=' . $v .': already in before ';     
            	$found = true;
        	} //end if  
		}//end foreach with $val_b       
    }//end foreach2 with $array
    // if $found match is false, then start insert these data from $array
    if (!$found){
    	echo "<br>".
        $insert = "INSERT INTO school_list(name_school,status)VALUES('".$val_a."','ACTIVE')";
        if($result = mysqli_query($conn , $insert)){
        	echo '<br>'. $val_a  .': insert successful  ';	
        }else{
        	echo '<br>'. $val_a  .': fail insert';	
        }// end if else for insert data
    }// end if !$found
}//end foreach with $array 
?>