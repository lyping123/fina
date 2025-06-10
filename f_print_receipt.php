<?php
require('include/include.php');
//require_once('fpdf182/fpdf.php');


// class PDF extends FPDI
// {
//     protected $_tplIdx;

//     public function Header()
//     {
//         if (null === $this->_tplIdx) {
//             $this->setSourceFile('Letterhead.pdf');
//             $this->_tplIdx = $this->importPage(1);
//         }

//         $this->useTemplate($this->_tplIdx);
//     }
// }

// require_once('fpdi182/fpdi.php');
$qry = "SELECT *,r.s_name AS old_name,r.r_date as newdate,r.createby as newid FROM f_receipt AS r
		LEFT JOIN f_b_c AS bc ON bc.r_id = r.id 
		LEFT JOIN student AS s ON s.id = r.s_id
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
                            }elseif($row['cash_bill_option'] == 'Tuition PTPK Seft pay'){
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
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
<title>Invoice</title>
</head>
<!-- onLoad="window.print()" -->
<body id="content"  style="font-family: Arial;">
<div style=" width:90%; margin-left:auto; margin-right:auto; padding:10px">
  <table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
        <td width="1%" valign="middle"><div><img src="img/images.png"/></div></td>
        <td colspan="3" width="100%">
            <div style="display:inline-block; padding:0px 20px">
                <p><small><span style="font-size:20px; font-weight:bold">Synergy Central Academy Sdn Bhd (889213 - K)</span></small><br />
                <small>
                Email : support@synergycollege.edu.my<br />
                <!--Tel : 04-3984787 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp	Fax : 04-3984787<br />
                Prai : No. 32 & 34, Jalan Perai Jaya 4, Bandar Perai Jaya, 13600 Perai, Penang.<br />
                KL : No. 3-2, Jalan Metro Perdana Barat 2, Tmn. Usahawan Kepong, Kepong Utara, KL.<br />
                Johor : No. 29-01, Jalan Molek 2/1, Taman Molek, 81100 Johor Bahru, Johor.-->
                    
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
            <table width="70%" style="border-collapse: collapse;border: 1px solid black;">
                <tr>
                    <td align="left">
                    Name: <?php if($row['s_name'] == ''){ echo $row['old_name'];}else{ echo $row['s_name'];}?>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                    IC: <?php if($row['s_ic'] == ''){ echo $row['ic'];}else{ echo $row['s_ic'];}?>
                    </td>
                </tr>
            </table>
        <!-- <strong>To</strong>:<br /><?=$row_detail['cus_lname']." ".$row_detail['cus_fname']?><br /><?=$row_detail['cus_address']?><br /><?=$row_detail['cus_postcode']." ".$row_detail['cus_states']?><br /><?=$row_detail['cus_country']?>-->
        
        </td>
    
        <td colspan="1" valign="bottom" width="30%" align="right">
            <div style="<!--direction:rtl-->;text-align: left;">
                <strong>Official Receipt </strong><br />
                <strong>No</strong>: <?=$r_no?><br />
                <strong>Date </strong>: <?=date_format(new DateTime($row['newdate']),'d-m-Y')?>
            </div>
        </td>
    </tr>
  </table>
  <hr />
    <br />
  
  <table width="100%" border="0" cellspacing="2" cellpadding="4" style="font-size:14px">
  
  <tr bgcolor="#999999">
    <th rowspan="2" align="center" class="border" colspan="2">Description</th>
    <th colspan="2" align="center" class="border">Amount</th>
  </tr>
  <tr bgcolor="#999999">
    <th align="center" class="border">RM</th>
    <th align="center" class="border">Cts</th>
  </tr>
  <?php 
  	$rd_qry = "SELECT * FROM f_receipt_detail WHERE r_id = '".$_GET['id']."'";
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
			if($row['pay_mtd'] == 'bankin' && $row['cheque_no'] == 'BANKIN'){
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
            <tr>
                <td align="center">
                Payment Reference: <?=$row['payment_reference']?>
                </td>
            </tr>
        <?php }elseif($row['pay_mtd'] == 'cheque' && $row['cheque_no'] != 'BANKIN'){?>
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
        <?php }elseif(($row['pay_mtd'] == 'credit card' || $row['pay_mtd'] == 'debit card') && $row['cheque_no'] != 'BANKIN'){
            
        ?>
            <tr>
                <td align="center">
                <?=$row["pay_mtd"]?> No: <?php echo "xxxxxxxxxxxx".$row["cheque_no"];?>
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
        <?php } ?>
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
      <td style="border:0px;font-weight:bold;"><p>* Fee Paid are not refundable</p></td>
      <td style="border:0px" align="right"><p>Total</p></td>
      <td bgcolor="#E9E9E9" align="center" class="border"><?=$t_rm?></td>
      <td bgcolor="#E9E9E9" align="center" colspan="" class="border">
      	<?=$t_cts?>
      </td>	
    </tr>
    
  <tr>
    <td><?php if(!empty($row['remark'])){?> <p style="top: -45px;position: relative;">Remark: <?=$row['remark']?></p><?php }?></td>
    <td></td>
    <td></td>
  </tr>
  
    <tr>
        <td> 
        <div class="bottomleft">
            <table width="30%">
                <tr>
                <?php 
                $uname=$row_n["l_name"];
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
                    <td colspan="2" align="center" valign="bottom">
                    <i style="text-decoration: underline; font-size:25px; font-family:'Dancing Script', cursive;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?=$sig?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</i>               
                    </td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2" align="center" valign="bottom">
                   
                    </td>
                </tr>
                <tr>
                <td colspan="2" align="center">
                    	<i>Issue by</i>
                    </td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2" align="center" >
                     
                    </td> 
                </tr>
                
            </table>
        </td>
    </tr>
  </table>		
 
</div>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<script src="js/jquery.js"></script>
<script>

//  function demoFromHTML() {
//         var pdf = new jsPDF();
//         // source can be HTML-formatted string, or a reference
//         // to an actual DOM element from which the text will be scraped.
//         source = $('#content')[0];

//         // we support special element handlers. Register them with jQuery-style 
//         // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
//         // There is no support for any other type of selectors 
//         // (class, of compound) at this time.
//         specialElementHandlers = {
//             // element with id of "bypass" - jQuery style selector
//             '#bypassme': function (element, renderer) {
//                 // true = "handled elsewhere, bypass text extraction"
//                 return true
//             }
//         };
//         margins = {
//             top: 80,
//             bottom: 60,
//             left: 40,
//             width: 522
//         };
//         // all coords and widths are in jsPDF instance's declared units
//         // 'inches' in this case
//         pdf.fromHTML(
//             source, // HTML string or DOM elem ref.
//             margins.left, // x coord
//             margins.top, { // y coord
//                 'width': margins.width, // max width of content on PDF
//                 'elementHandlers': specialElementHandlers
//             },

//             function (dispose) {
//                 // dispose: object with X, Y of the last line add to the PDF 
//                 //          this allow the insertion of new lines after html
//                 pdf.save('Test.pdf');
//             }, margins
//         );
//     }
// var doc = new jsPDF();          
// var elementHandler = {
//   '#ignorePDF': function (element, renderer) {
//     return true;
//   }
// };
// var source = window.document.getElementsByTagName("body")[0];
// doc.fromHTML(
//     source,
//     15,
//     15,
//     {
//       'width': 180,'elementHandlers': elementHandler
//     });

// doc.output("dataurlnewwindow");

</script>
