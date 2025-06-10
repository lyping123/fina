<?php
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_choose'){
	$system_msg .= systemMsg('alert-warning','Attention!','Please select a format to print receipt.');	
}
?>
    <div class="container">
<?php 
	if(isset($system_msg)){echo $system_msg;}
?>
    <a class="btn btn-primary" href="f_receipt_form.php?action=msg_save" onclick="window.open('f_print_receipt.php?&id=<?=$_GET['id']?>', '_blank')"> Print (Synergy Central Academy)</a>
    <a class="btn btn-primary" href="f_receipt_form.php?action=msg_save"  onclick="window.open('f_print_receipt1.php?&id=<?=$_GET['id']?>', '_blank')"> Print (Pusat Kemahiran Telekomunikasi Mikro)</a>
<?php require('footer.php');?>s