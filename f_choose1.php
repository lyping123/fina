<?php
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_choose'){
	$system_msg .= systemMsg('alert-warning','Attention!','Please select a format to print receipt.');	
}

$qry = "SELECT * FROM f_receipt WHERE id = '".$_GET['id']."'";
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($result);
?>
    <div class="container">
<?php 
	if(isset($system_msg)){echo $system_msg;}
	if($row['receipt_type'] == '2'){
?>
    <a class="btn btn-primary" href="f_receipt_form1.php?action=msg_save" onclick="window.open('f_print_receipt.php?&id=<?=$_GET['id']?>', '_blank')"> Print (Synergy Central Academy)</a>
<?php }elseif($row['receipt_type'] == '1'){?>
    <a class="btn btn-primary" href="f_receipt_form1.php?action=msg_save"  onclick="window.open('f_print_receipt1.php?&id=<?=$_GET['id']?>', '_blank')"> Print (Pusat Kemahiran Telekomunikasi Mikro)</a>
<?php }?>
     <a class="btn btn-success" href="submit_lhdn.php?id=<?=$_GET['id']?>&action=lhdn_submit" >Submit to lhdn</a>

<?php require('footer.php');?>