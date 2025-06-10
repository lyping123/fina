<?php 
include("include/db.php");

// $sql="select * from f_receipt where id in(8139,8634,8635,8636,8637,8638,8639,8640,8641,8642,8643,8644,8645,8646,8647,8648,8649,8650,8651,8652,8653,8654,8655,8656,8657,8658,8659,8660,8661,8662,8663,8664,8665,8666,8667,8668,8669,8670,8671,8672,8673,8729,8730,8731,8732,8745,8746,8747,8748,8749,8750,8751) order by id asc";
// $sttr=mysqli_query($conn,$sql);

$sql="select * from f_receipt where id between 8875 and 8926 order by id desc";
$sttr=mysqli_query($conn,$sql);

$sql1="select * from f_b_c where r_id in(8139,8634,8635,8636,8637,8638,8639,8640,8641,8642,8643,8644,8645,8646,8647,8648,8649,8650,8651,8652,8653,8654,8655,8656,8657,8658,8659,8660,8661,8662,8663,8664,8665,8666,8667,8668,8669,8670,8671,8672,8673,8729,8730,8731,8732,8745,8746,8747,8748,8749,8750,8751) order by r_id asc";
$sttr1=mysqli_query($conn,$sql1);

$array=array();
$array1=array();

while($row1=mysqli_fetch_array($sttr1)){
    $array1[]=$row1["r_id"];
}
$i=0;
while($row=mysqli_fetch_array($sttr)){
    
    //$array[]="('$row[r_no]','$row[r_date]','$row[s_name]','$row[s_ic]','$row[pay_mtd]','ACTIVE','$row[createdate]','$row[createby]','$row[debtor]','$row[receipt_type]','$row[debtor_ptpk]','$row[tuition_ptpk]','$row[cash_bill_option]','$row[s_id]','$row[new_remark]')";
    $update="update f_b_c set r_id='$row[0]' where r_id='$array1[$i]'";
    mysqli_query($conn,$update);
    $i++;

}



//print_r($array1);

//$new_sql=implode(",",$array);

//echo "insert into f_receipt(`r_no`, `r_date`, `s_name`, `s_ic`, `pay_mtd`,`r_status`, `createdate`, `createby`, `debtor`, `receipt_type`, `debtor_ptpk`, `tuition_ptpk`, `cash_bill_option`, `s_id`, `new_remark`) values".$new_sql;
?>