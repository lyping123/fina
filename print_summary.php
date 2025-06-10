<?php 
include("include/db.php");
//$course=$_GET["course"];


$qry="SELECT 
f.id,
f.pay_mtd,
f.cash_bill_option,
l.l_name,
DATE(f.r_date) AS r_date,
IF(f.s_name <> '', f.s_name, s.s_name) AS s_name,
IF(f.s_ic <> '', f.s_ic, s.ic) AS s_ic,
GROUP_CONCAT(fr.rp_desc, '(RM ', fr.rp_amount, ')'
    SEPARATOR '<hr>') AS descriptionn,
SUM(fr.rp_amount) AS total_amount,
IF(f.r_no <> '',
    f.r_no,
    IF(f.receipt_type = 1,
        (SELECT 
                LPAD(COUNT(frrr.id) + 10000,
                            7,
                            CASE
                                WHEN f.cash_bill_option = 'Debtor' THEN ' D'
                                WHEN f.cash_bill_option = 'Locker' THEN ' L'
                            END) AS r_no
            FROM
                f_receipt AS frrr
            WHERE
                frrr.r_status = 'ACTIVE'
                    AND frrr.receipt_type = f.receipt_type
                    AND frrr.cash_bill_option = f.cash_bill_option
                    AND frrr.id BETWEEN 1 AND f.id),
        (SELECT 
                LPAD(COUNT(frrr.id) + 10000,
                            7,
                            CASE
                                WHEN f.cash_bill_option = 'Debtor PTPK' THEN 'DP'
                                WHEN f.cash_bill_option = 'Debtor' THEN ' D'
                                WHEN f.cash_bill_option = 'Internal Exam Fee' THEN ' I'
                                WHEN f.cash_bill_option = 'Hostel Fee' THEN ' H'
                                WHEN f.cash_bill_option = 'Tuition PTPK' THEN 'TP'
                                WHEN f.cash_bill_option = 'Tuition Fee' THEN ' T'
                                WHEN f.cash_bill_option = 'Personal Bond' THEN ' P'
                                WHEN f.cash_bill_option = 'Enrollment Fee' THEN ' E'
                                WHEN f.cash_bill_option = 'Hostel Deposit' THEN 'HP'
                                WHEN f.cash_bill_option = 'laptop deposit' THEN 'LD'
                            END) AS r_no
            FROM
                f_receipt AS frrr
            WHERE
                frrr.r_status = 'ACTIVE'
                    AND frrr.receipt_type = f.receipt_type
                    AND frrr.cash_bill_option = f.cash_bill_option
                    AND frrr.id BETWEEN 1 AND f.id))) AS r_no
FROM
f_receipt AS f
    LEFT JOIN
student AS s ON s.id = f.s_id
    INNER JOIN
f_receipt_detail AS fr ON fr.r_id = f.id
    INNER JOIN
login AS l ON l.id = f.createby
WHERE
f.r_status = 'ACTIVE' AND f.cash_bill_option = '".$_GET['c_type']."'  AND (f.r_date >= '".$_GET['s_date']."' AND f.r_date<='".$_GET["e_date"]."') 
GROUP BY f.id
ORDER BY f.id DESC";

$sttr=mysqli_query($conn,$qry);
$count=mysqli_num_rows($sttr);
$i=0;
$ii=0;
$index=0;
$table="";
$divided=$count/50;
$div=explode(".",$divided);

$type="";
while($row=mysqli_fetch_array($sttr)){
    $ii++;
    $i++;
    $c_include="";
    
    $table.="<tr>
    <td>".$ii."</td>
    <td>".$row['r_no']."</td>
    <td>".$row['r_date']."</td>
    <td>".$row['s_name']."</td>
    <td>".$row['cash_bill_option']."</td>
    <td>RM ".$row['total_amount']."</td>
    </tr>";
    $array[$index]=$table;
    if($i==50){
        $i=0;
        $table="";
        $index++;
    }
    $type=$row['cash_bill_option'];
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student <?=$type?> Summary</title>
</head>
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
        margin: 10mm 5mm 10mm 5mm; /* margin you want for the content */
		-webkit-print-color-adjust:exact;
    }
</style>


<body>
<div style=" width:100%; margin-left:auto; margin-right:auto;">
<style>

table {
    border-collapse: collapse;
	font-size: 10px;
}

table, th, td {
    border: 1px solid black;
}
	
td {
    text-align: left;
    padding-left:2px;
    
}
</style>

  

  <?php for($a=0;$a<=$div[0];$a++){ ?>
	<div class="table-responsive printArea" style="padding-top:20px;"  >
		<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
			<div style="display:inline-block; padding:0px">
				<p><small><span style="font-size:20px; font-weight:bold">Student <?=$type?> Summary</span></small>
			</div>
			<thead>
				<tr>
                    <th>No</th>
                    <th>Receipt No</th>
					<th>Date</th>
					<th>Student Name</th>
					<th>Cash Bill Type</th>
					<th>Price</th>
			
				</tr>
			</thead>
			<tbody>
				<?php echo $array[$a]; ?>
			</tbody>
		</table>
	</div>
  <?php } ?>
   
           
    </div>
   
    </div>
</body>

</html>
<script>
var divsToPrint = document.getElementsByClassName('printArea'), n;

for (n = 0; n < divsToPrint.length; n++) {
    printDiv(divsToPrint[n]);
}

function printDiv(div) {
    var newWin= window.open('', 'win');
    newWin.document.write("<style>");
    newWin.document.write("table{ border-collapse: collapse;font-size: 10px;}table, th, td {border: 1px solid black;} td{text-align:left;padding-left:2px;}");
    newWin.document.write("</style>");
    newWin.document.write(div.innerHTML);
    newWin.location.reload();
    newWin.focus();
    newWin.print();
    newWin.close();
}
</script>
