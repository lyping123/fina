<?php 
include("include/db.php");
//$course=$_GET["course"];


$qry="select * from mou order by c_name";

$sttr=mysqli_query($conn,$qry);
$count=mysqli_num_rows($sttr);
$i=0;
$ii=0;
$index=0;
$table="";
$divided=$count/15;
$div=explode(".",$divided);


while($row=mysqli_fetch_array($sttr)){
    $ii++;
    $i++;
    $c_include="";
    if($row['pro']=="yes"){
        $c_include.="Programming,"."</br>";
    }
    if($row['mul']=="yes"){
        $c_include.="Multiple"."</br>";
    }
    if($row['elc']=="yes"){
        $c_include.="Electronic"."<br>";
    }
    if($row['net']=="yes"){
        $c_include.="Networking"."<br>";
    }
    if($row['acc']=="yes"){
        $c_include.="Accounting";
    } 
    $table.="<tr>
    <td>".$ii."</td>
    <td>".$row['c_name']."</td>
    <td>".$row['c_address']."</td>
    <td>".$row['c_tel']."</td>
    <td>".$row['name']."</td>
    <td>".$row['position']."</td>
    <td>".$row['tel']."</td>
    <td>".$row['email']."</td>
    <td>".$c_include."</td>
    </tr>";
    $array[$index]=$table;
    if($i==15){
        $i=0;
        $table="";
        $index++;
    }
    
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Memorandum of Understanding( MOU )</title>
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
				<p><small><span style="font-size:20px; font-weight:bold">Memorandum of Understanding( MOU )</span></small>
			</div>
			<thead>
				<tr>
                    <th>No</th>
					<th>Company name</th>
					<th>Company address</th>
					<th>Campany contact number</th>
					<th>HR manager name</th>
					<th>Position</th>
					<th>Contact number</th>
					<th>Email</th>
                    
                    <th>Course included</th>
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
