<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include("include/db.php");

$qry="SELECT MIN(f.id),MIN(f.r_date) as r_date ,s.s_name,s.id as s_id,s.s_email FROM f_receipt f
INNER JOIN student s ON f.s_id=s.id
WHERE f.cash_bill_option='Hostel Fee' AND s.s_status='ACTIVE' AND s.h_status='YES'  GROUP BY f.s_id ORDER BY f.id ASC" ;
$sttr=mysqli_query($conn,$qry);
$result=mysqli_num_rows($sttr);

$i=0;
if($result>0){
    $table="";
    while($row=mysqli_fetch_array($sttr)){
        $r_date=$row["r_date"];
        $date=new DateTime($r_date);

        $currentdatetime= new DateTime();
        $interval=$date->diff($currentdatetime);
        $total_months = $interval->y * 12 + $interval->m;
        $periods_of_six_months = ceil($total_months / 6);
        $qry2="SELECT rp_amount FROM f_receipt_detail WHERE r_id=$row[0]";

        $sttr2=mysqli_query($conn,$qry2);
        $row2=mysqli_fetch_array($sttr2);
        $paid_amount=$row2["rp_amount"];

        $total_shouldpaid=$periods_of_six_months*$paid_amount;

        $qry1="SELECT SUM(fd.rp_amount) as total,DATE_FORMAT(MAX(f.r_date),'%Y-%m-%d') as latest_date FROM f_receipt f
        INNER JOIN f_receipt_detail as fd on fd.r_id=f.id
        WHERE f.cash_bill_option='Hostel Fee' AND f.s_id='$row[s_id]'";
        $sttr1=mysqli_query($conn,$qry1);
        $row1=mysqli_fetch_array($sttr1);
        $total=$row1["total"];
        $latest_date=$row1["latest_date"];
        $total_outstading=$total_shouldpaid-$total;


        $date=new DateTime($latest_date);
        $interval=$date->diff($currentdatetime);
        $latest_months = $interval->y * 12 + $interval->m;
        
        
        $date->modify("+$periods_of_six_months month");
        $expiry_date=$date->format('Y-m-d');
        
        $newexpiry_date=new DateTime($expiry_date);
        $newexpiry_date->modify("-7 day");
        $remind_date=$newexpiry_date->format('Y-m-d');


        $datenow=new DateTime(date('Y-m-d'));
        $daysleft=$newexpiry_date->diff($datenow)->format('%a');
        $dateex=new DateTime("2023-12-01");

        if($total_outstading>0 && $total_outstading<2000 && $newexpiry_date>$dateex){
            $i++;
            $table.="<tr>
                <td>$i</td>
                <td>$row[s_name]</td>
                <td>$total_outstading</td>
                <td>$row1[latest_date]</td>
                <td>$remind_date</td>
            </tr>";  
        } 
    }
}

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
				<p><small><span style="font-size:20px; font-weight:bold">Outstanding Of(Hostel Fee )</span></small>
			</div>
			<thead>
                    <th>No</th>
                    <th>Student Name</th>
                    <th>Total pay</th>
                    <th>Last Payment date</th>
                    <th>remind date</th>
			</thead>
			<tbody>
				<?php echo $table; ?>
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
