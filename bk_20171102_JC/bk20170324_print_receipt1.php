<?php
require('include/include.php');
$qry = "SELECT * FROM receipt AS r
		LEFT JOIN b_c AS bc ON bc.r_id = r.id 
		WHERE r.id = '".$_GET['id']."'";
$sql = mysqli_query($conn,$qry);
$row = mysqli_fetch_array($sql);
$num = mysqli_num_rows($sql);
?>

<style type="text/css" media="print">
    @page 
    {
        size:  auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }

    html
    {
        background-color: #FFFFFF; 
        margin: 0px;  /* this affects the margin on the html before sending to printer */
    }

    body
    {
        /*border: solid 1px blue ;*/
        margin: 10mm 0mm 10mm 0mm; /* margin you want for the content */
    }
</style>

<style>
table {
    border-collapse: collapse;
}

.border{
    border: 1px solid black;
}
.bottomleft {
  position: fixed;
  bottom: 60px;
}

</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" moznomarginboxes>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Invoice</title>
</head>

<body onLoad="window.print()">
<div style=" width:90%; margin-left:auto; margin-right:auto; padding:10px">
  <table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
        <td width="1%" valign="middle"><div><img src="img/images.png"/></div></td>
        <td colspan="3" width="100%">
            <div style="display:inline-block; padding:0px 20px">
                <p><small><span style="font-size:22px; font-weight:bold">Pusat Kemahiran Telekomunikasi Mikro (L02065)</span></small><br />
                <small>
                Email : support@synergycollege.edu.my<br />
                Tel : 04-3984787/04-3904189 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp	Fax : 04-3984787<br />
                No. 6, 8, 10, Jalan Perai Jaya 1, Bandar Perai Jaya, 13600 Perai, Penang.<br />
                No. 32, 34, 40, 42, 44, 46, 48, Jalan Perai Jaya 4, Bandar Perai Jaya, 13600 Perai, Penang.
                </small></p>
            </div>
        </td>
    </tr>
    
    <tr>
        <td colspan="2">
    <br />
    <br />
            <table width="50%" style="border-collapse: collapse;border: 1px solid black;">
                <tr>
                    <td align="center">
                    Name: <?=$row['s_name']?>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                    IC: <?=$row['s_ic']?>
                    </td>
                </tr>
            </table>
        <!-- <strong>To</strong>:<br /><?=$row_detail['cus_lname']." ".$row_detail['cus_fname']?><br /><?=$row_detail['cus_address']?><br /><?=$row_detail['cus_postcode']." ".$row_detail['cus_states']?><br /><?=$row_detail['cus_country']?>-->
        
        </td>
    
        <td colspan="1" valign="bottom" width="10%" align="right">
            <div style="<!--direction:rtl-->">
                <strong>No </strong>: <?=$row['r_no']?><br />
                <strong>Date </strong>: <?=date_format(new DateTime($row['r_date']),'d-m-Y')?>
            </div>
        </td>
    </tr>
  </table>
  <hr />
    <br />
  
  <table width="100%" border="0" cellspacing="2" cellpadding="4" style="font-size:10px">
  
  <tr bgcolor="#999999">
    <th rowspan="2" align="center" class="border" colspan="2">Description</th>
    <th colspan="2" align="center" class="border">Amount</th>
  </tr>
  <tr bgcolor="#999999">
    <th align="center" class="border">RM</th>
    <th align="center" class="border">Cts</th>
  </tr>
  <?php 
  	$rd_qry = "SELECT * FROM receipt_detail WHERE r_id = '".$_GET['id']."'";
	$rd_result = mysqli_query($conn,$rd_qry);
	$rd_count = mysqli_num_rows($rd_result);
	
	if($rd_count == 1){
		$height = '480px';
	}elseif($rd_count == 2){
		$height = '460px';
	}elseif($rd_count == 3){
		$height = '440px';
	}elseif($rd_count == 4){
		$height = '420px';
	}elseif($rd_count == 5){
		$height = '400px';
	}elseif($rd_count == 6){
		$height = '380px';
	}elseif($rd_count == 7){
		$height = '360px';
	}elseif($rd_count == 8){
		$height = '340px';
	}elseif($rd_count == 9){
		$height = '320px';
	}elseif($rd_count == 10){
		$height = '300px';
	}elseif($rd_count == 11){
		$height = '280px';
	}elseif($rd_count == 12){
		$height = '260px';
	}elseif($rd_count == 13){
		$height = '240px';
	}elseif($rd_count == 14){
		$height = '220px';
	}elseif($rd_count == 15){
		$height = '200px';
	}elseif($rd_count == 16){
		$height = '180px';
	}elseif($rd_count == 17){
		$height = '160px';
	}elseif($rd_count == 18){
		$height = '140px';
	}elseif($rd_count == 19){
		$height = '120px';
	}elseif($rd_count == 20){
		$height = '100px';
	}
	
	$total = '';
	while($rd_row = mysqli_fetch_array($rd_result)){
		$str = $rd_row['rp_amount'];
		$new_str = explode(".",$str);
		$rm = $new_str[0];
		
		
		if(!empty($new_str[1])){
			$length1 = strlen($new_str[1]);
			if($length1 == 1){
				$new_cts = $new_str[1]*10;
			}elseif($length1 == 2){
				$new_cts = $new_str[1];
			}
		}else{
			$new_cts = '00';
		}
		
		
		$total += $rd_row['rp_amount'];
  ?>
  <tr>
    <td align="center" class="border" colspan="2"><?=$rd_row['rp_desc']?></td>
    <td align="center" class="border"><?=$rm?></td>
    <td align="center" class="border"><?=$new_cts?></td>
  </tr>
  <?php }?>

  <tr style="height:<?=$height?>">
    <td align="center" class="border" colspan="2">
        <table width="70%" style="border-collapse: collapse;border: 1px solid black;">
        <?php
			if($row['cheque_no'] == 'BANKIN'){
		?>
            <tr>
                <td align="center">
                Banker: <?=$row['banker']?>
                </td>
            </tr>
            <tr>
                <td align="center">
                Dated: <?=$row['in_date']?>
                </td>
            </tr>
        <?php }elseif(!empty($row['cheque_no']) && $row['cheque_no'] != 'BANKIN'){?>
            <tr>
                <td align="center">
                Cheque No: <?=$row['cheque_no']?>
                </td>
            </tr>
            <tr>
                <td align="center">
                Banker: <?=$row['banker']?>
                </td>
            </tr>
            <tr>
                <td align="center">
                Dated: <?=$row['in_date']?>
                </td>
            </tr>
        <?php }?>
        </table>
    </td>
    <td align="center" class="border"></td>
    <td align="center" class="border"></td>
  </tr>
  <?php
  		$new_total = explode(".",$total);
	
		$t_rm = $new_total[0];
		
		
		if(!empty($new_total[1])){
			$length = strlen($new_total[1]);
			if($length == 1){
				$t_cts = $new_total[1]*10;
			}elseif($length == 2){
				$t_cts = $new_total[1];
			}
		}else{
			$t_cts = '00';
		}
  ?>
    <tr>
      <td style="border:0px"><p>* Fee Paid are not returnable</p></td>
      <td style="border:0px" align="right"><p>Total</p></td>
      <td bgcolor="#E9E9E9" align="center" class="border"><?=$t_rm?></td>
      <td bgcolor="#E9E9E9" align="center" colspan="" class="border">
        <strong><?=$t_cts?></strong>
      </td>	
    </tr>
    
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  
    <tr>
        <td colspan=""> 
        <div class="bottomleft">
            <table width="30%">
                <tr >
                    <td colspan="2" align="center" valign="bottom">
                    __________________________
                    </td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2" align="center" valign="bottom">
                    __________________________
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2" align="center">
                    	<i>Issue by</i>
                    </td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2" align="center" >
                    	<i>Student Signature</i>
                    </td>
                </tr>
                
            </table>
        </td>
    </tr>
  </table>		
 
</div>
</body>
</html>