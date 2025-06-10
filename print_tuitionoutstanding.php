<?php 
include("include/db.php");

$status="";
$title="";
if(isset($_GET["bill_type"]) && $_GET["bill_type"]=="selected"){
    $qry="SELECT s.id,s.s_name,s.s_email,s.tuition_fee,DATE_FORMAT(f.r_date, '%Y-%m') as ym,SUM(fd.rp_amount) as total_amount,fd.rp_desc,DATE_FORMAT(MAX(f.r_date), '%Y-%m-%d') as r_date,
    if(CURDATE()<DATE(t_end),TIMESTAMPDIFF(MONTH,DATE(t_start),CURDATE()),TIMESTAMPDIFF(MONTH,DATE(t_start),DATE(t_end))) as month_difference,s.month_pay FROM student s 
    INNER JOIN f_receipt f ON f.s_id=s.id
    INNER JOIN f_receipt_detail fd ON fd.r_id=f.id
    WHERE s.p_method='ptpk' AND s.s_status='ACTIVE' AND (cash_bill_option='Tuition Fee' OR cash_bill_option='Tuition PTPK Self Pay')
    GROUP BY s.id,s.s_name";
    $sttr=mysqli_query($conn,$qry);
    $count=mysqli_num_rows($sttr);

    $status="selected";

    $title="Tuition PTPK";
   
}else{
    $qry="SELECT s.id,s.s_name,s.s_email,s.tuition_fee,DATE_FORMAT(f.r_date, '%Y-%m') as ym,SUM(fd.rp_amount) as total_amount,fd.rp_desc,DATE_FORMAT(MAX(f.r_date), '%Y-%m-%d') as r_date FROM student s 
    INNER JOIN f_receipt f ON f.s_id=s.id
    INNER JOIN f_receipt_detail fd ON fd.r_id=f.id
    WHERE s.p_method='semester' AND s.s_status='ACTIVE' AND cash_bill_option='Tuition Fee' 
    GROUP BY s.id,s.s_name
    HAVING total_amount<s.tuition_fee";
    $sttr=mysqli_query($conn,$qry);
    $count=mysqli_num_rows($sttr);
    $status="ptpkselected";

    $title="Tuition Fee";
}


$i=0;
$ii=0;
$index=0;
$table="";
$divided=$count/15;
$div=explode(".",$divided);




?>

<style>
    .selected{
        background-color: white;
        color: black;
    }
</style>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Synergy portal</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/3-col-portfolio.css" rel="stylesheet">
    
    <link rel="stylesheet" href="css/styles.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" media="screen">
    
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
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


<body>

	<div class="table-responsive printArea" style="padding-top:20px;"  >
		<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
			<div style="display:inline-block; padding:0px">
				<p><small><span style="font-size:20px; font-weight:bold">Outstanding Of(<?=$title?> )</span></small>
			</div>
			<thead>
                    <th>No</th>
                    <th>Student Name</th>
                    <th>Total pay</th>
                    <th>Last Payment date</th>
                    <th>Outstanding</th>
                    <th>remind date</th>
			</thead>
			<tbody>
				<?php 
                if($status=="selected"){
                    while($result=mysqli_fetch_array($sttr)){
                        
                        
                        $datereceipt=new DateTime($result['r_date']);
                        $dateafteronemonth=$datereceipt->modify('+1 month')->format("Y-m");
                        $last_receiptdate=date_format($datereceipt,"Y-m");
                        $month=$result["month_difference"]+2;
                        $total_outstanding=$result["month_pay"]*$month-$result["total_amount"];
                        $datenow=new DateTime(date("Y-m-d"));
                
                        if($total_outstanding>0){ 
                            $ii++;
                            echo "<tr>
                            <td>".$ii."</td>
                            <td>".$result['s_name']."</td>
                            <td>".$result['total_amount']."</td>
                            <td>".$result['r_date']."</td>
                            <td>".$total_outstanding."</td>
                            <td>".$dateafteronemonth."</td>
                        </tr>";
                        }
                        
                    }
                }else{
                    $ii++;
                    while($row=mysqli_fetch_array($sttr)){
                        
                        $datereceipt=new DateTime($row['r_date']);
                        $dateaftersixmonth=$datereceipt->modify('+6 month')->format("Y-m");
                        $last_receiptdate=date_format($datereceipt,"Y-m");
                        $datenow=new DateTime(date("Y-m-d"));
                
                
                        echo "<tr>
                        <td>".$ii."</td>
                        <td>".$row['s_name']."</td>
                        <td>".$row['total_amount']."</td>
                        <td>".$row['r_date']."</td>
                        <td>".$dateaftersixmonth."</td>
                        </tr>";
                        echo $table;
                    }
                }
                
                ?>
			</tbody>
		</table>
	</div>

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
</body>
</html>
