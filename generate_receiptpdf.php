<?php
require('include/include.php');

$type="";
$qry = "SELECT *,r.s_name AS old_name,r.r_date as newdate,r.createby as newid FROM f_receipt AS r
		LEFT JOIN f_b_c AS bc ON bc.r_id = r.id 
		LEFT JOIN student AS s ON s.id = r.s_id
        INNER JOIN login as l ON l.id=r.createby
		WHERE r.id = '".$_GET['id']."'";
$sql = mysqli_query($conn,$qry);
$row = mysqli_fetch_array($sql);
$num = mysqli_num_rows($sql);

$select="select * from login where id='".$row["newid"]."'";
$sttr=mysqli_query($conn,$select);
$row_n=mysqli_fetch_array($sttr);

                        if($row['receipt_type'] == 2){
                            if($row['cash_bill_option'] == 'Debtor PTPK'){
                                $type = 'DP';
                            }elseif($row['cash_bill_option'] == 'Debtor'){
                                $type = 'D';
                            }elseif($row['cash_bill_option'] == 'Internal Exam Fee'){
                                $type = 'I';
                            }elseif($row['cash_bill_option'] == 'Hostel Fee'){
                                $type = 'H';
                            }elseif($row['cash_bill_option'] == 'Tuition Fee'){
                                $type = 'T';
                            }elseif($row['cash_bill_option'] == 'Tuition PTPK'){
                                $type = 'TP';
                            }elseif($row['cash_bill_option'] == 'Tuition PTPK Auto debit'){
                                $type = 'TPA';
                            }elseif($row['cash_bill_option'] == 'Tuition PTPK Self pay'){
                                $type = 'TPS';
                            }
                            elseif($row['cash_bill_option'] == 'Enrollment Fee'){
                                $type = 'E';
                            }
                            elseif($row['cash_bill_option'] == 'laptop deposit'){
                                $type = 'LD';
                            }

                            if($row['r_no'] == ''){
                                $rno_qry = "SELECT count(fr.id) AS r_no FROM f_receipt AS fr WHERE fr.r_status = 'ACTIVE' AND fr.receipt_type = '".$row['receipt_type']."' AND fr.cash_bill_option = '".$row['cash_bill_option']."' AND fr.id BETWEEN 1 AND ".$_GET['id'];
                                $rno_result = mysqli_query($conn, $rno_qry);
                                $rno_row = mysqli_fetch_array($rno_result);
                                $r_no = 10000 + $rno_row['r_no'];
                                $r_no = $type.$r_no;
                            }else{
                                $r_no = $row['r_no'];
                            }
                        }else{
                            if($row['r_no'] == ''){
                                $rno_qry = "SELECT count(fr.id) AS r_no FROM f_receipt AS fr WHERE fr.r_status = 'ACTIVE' AND fr.receipt_type = '".$row['receipt_type']."' AND fr.cash_bill_option = '".$row['cash_bill_option']."' AND fr.id BETWEEN 1 AND ".$_GET['id'];
                                $rno_result = mysqli_query($conn, $rno_qry);
                                $rno_row = mysqli_fetch_array($rno_result);
                                $r_no = 10000 + $rno_row['r_no'];
                                $r_no = 'D'.$r_no;
                            }else{
                                $r_no = $row['r_no'];
                            }
                        }

?>



<?php
// assume $row, $r_no, $rd_result, etc. already prepared in f_print_receipt.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Official Receipt</title>
<style>
    @page { size: A4; margin: 20mm; }
    body { font-family: Arial, sans-serif; font-size: 12px; color: #000; }
    table { border-collapse: collapse; width: 100%; }
    .tableheight{
        height: 540px;
    }
    .border { border: 1px solid #000; }
    .header-table td { vertical-align: top; }
    .vertical-bot{ vertical-align: bottom;}
    .receipt-title { font-size: 20px; font-weight: bold; }
    .company-info { font-size: 12px; line-height: 1.3; }
    .section { margin: 10px 0; }
    .small-title{ font-size: 16px;}
    .bottomleft { position: absolute; bottom: 60px; font-size: 11px; }
    .signature { font-family: 'Dancing Script', cursive; font-size: 20px; text-decoration: underline; }
    
</style>
</head>
<body>

<!-- Header -->
<table class="header-table">
  <tr>
    <td width="80">
     <?php
    $logoPath = __DIR__ . "/img/images.png"; // absolute filesystem path
    $logoBase64 = "data:image/png;base64," . base64_encode(file_get_contents($logoPath));
    ?>
    <img src="<?= $logoBase64?>" style="width:100px;">

    </td>
    <td>
      <div class="receipt-title">KOLEJ SYNERGY <span class="small-title">(L02065)</span></div>
      <div class="receipt-title">SYNERGY CENTRAL ACADEMY SDN BHD <span class="small-title">(889213 - K)</span></div>
      <div class="company-info">
        30, 32, 34, 36, 38, 40, 42, 44, 46, 48 Jalan Perai Jaya 4, Bandar Perai Jaya, 13600 Perai, Penang.<br>
        8, 10 Jalan Perai Jaya 1, Bandar Perai Jaya, 13600 Perai, Penang.<br>
        <span>Tel: 04-3984787</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class='f-right'>Email: support@synergycollege.edu.my</span><br>
        
      </div>
    </td>
  </tr>
</table>



<!-- Student Info -->
<div style="width:100%;" >
  <table width="100%" class="section" >
    <tr>
      <td width="40%" class="border">Name : <?= $row['s_name'] ?: $row['old_name'] ?><br>
        IC &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $row['s_ic'] ?: $row['ic'] ?>  
      </td>
      <td align="right">
        <strong>Official Receipt</strong><br>
        <strong>No: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> <?=$r_no?><br>
        <strong>Date:</strong> <?= date('d-m-Y', strtotime($row['newdate'])) ?>
      </td>
    </tr>
  </table>
</div>
<hr>
<br>

<!-- Receipt Details -->
<table class="border">
  <tr style="background:#ccc;">
    <th colspan="2" rowspan="2" class="border">Description</th>
    <th colspan="2">Amount</th>
  </tr>
  <tr style="background:#ccc;">
    
    <th class="border">RM</th>
    <th class="border">Cts</th>
  </tr>
  

  <?php
  $total = 0;
  $rd_result = mysqli_query($conn, "SELECT * FROM f_receipt_detail WHERE r_id = '".$_GET['id']."'");
  while($rd_row = mysqli_fetch_array($rd_result)) {
      $parts = explode('.', $rd_row['rp_amount']);
      $rm = $parts[0];
      $cts = isset($parts[1]) ? str_pad($parts[1], 2, '0', STR_PAD_RIGHT) : '00';
      $total += $rd_row['rp_amount'];

  ?>
  
  <tr>
    <td colspan="2" class="border" align="center"><?= $rd_row['rp_desc'] ?></td>
    <td class="border" align="center"><?= $rm ?></td>
    <td class="border" align="center"><?= $cts ?></td>
  </tr>
  <?php } ?>
    <tr style="height:540px;" >
        <td colspan="2" class="border tableheight vertical-bot"  align="center" valign="middle">
            <div style="display:inline-block; text-align:center; padding:20px;"  class="border">
            <?php if ($row['pay_mtd'] == 'bankin' && $row['cheque_no'] == 'BANKIN') { ?>
                Banker: <?= $row['banker'] ?><br>
                Dated: <?= $row['in_date'] ?><br>
                Payment Reference: <?= $row['payment_reference'] ?>
            <?php } elseif ($row['pay_mtd'] == 'cheque') { ?>
                Cheque No: <?= $row['cheque_no'] ?><br>
                Banker: <?= $row['banker'] ?><br>
                Dated: <?= $row['in_date'] ?>
            <?php } elseif (in_array($row['pay_mtd'], ['credit card', 'debit card'])) { ?>
                <?= ucfirst($row['pay_mtd']) ?> No: xxxxxxxxxxxx<?= $row['cheque_no'] ?><br>
                Banker: <?= $row['banker'] ?><br>
                Dated: <?= $row['in_date'] ?>
            <?php } ?>
            </div>
        </td>
        <td class="border"></td>
        <td class="border"></td>
    </tr>

  <?php
  $parts = explode('.', $total);
  $t_rm = $parts[0];
  $t_cts = isset($parts[1]) ? str_pad($parts[1], 2, '0', STR_PAD_RIGHT) : '00';
  ?>

  <tr>
    <td colspan="2" align="right" class="border" style="font-size:10px;">Total</td>
    <td class="border" align="center" style="background:#eee; font-weight:bold;"><?= $t_rm ?></td>
    <td class="border" align="center" style="background:#eee; font-weight:bold;"><?= $t_cts ?></td>
  </tr>
</table>
<p>* Fee Paid are not refundable</p>

<!-- Payment Info -->
<?php 
$uname=$row["l_name"];
    switch ($uname) {
        case "wei ni":
            $sig="WN";
            break;
        case "yung yee":
            $sig="YY";
            break;
        case "hui xuan":
            $sig="Heah";
            break;
        case "Siti":
            $sig="Siti";
            break;
        case "Agnes":
            $sig="Agnes";
            break;
        default:
            $sig="";
        } 
?>

<!-- Signature -->
<table style="width: 20% !important;">
    <td width="100%" style="border-bottom: 1px soliad black;"  valign="bottom" align="center">
      <!-- signature -->
      <span style="font-family:'Dancing Script', cursive; font-size:25px; font-style: italic; display:inline-block; min-width:180px; text-align:center; border-bottom:1px solid #000;">
        <?= $sig ?>
        </span>
      <br>
      <small>Issued by</small>
    </td>
</table>

</body>
</html>




