<?php 
include("include/db.php");
//$course=$_GET["course"];

$spite_date=explode("-",$_POST["daterange"]);


$qry="select * from visitor where date(v_date) between date('$spite_date[0]') AND date('$spite_date[1]') and v_status='ACTIVE' order by v_date desc";

$sttr=mysqli_query($conn,$qry);
$count=mysqli_num_rows($sttr);

$i=0;
$ii=0;
$index=0;
$table="";
$divided=$count/30;
$div=explode(".",$divided);
$array=array();

while($row=mysqli_fetch_array($sttr)){
    $ii++;
    $i++;
    $table.="<tr>
    <td>".$ii."</td>
    <td>".$row['s_name']."</td>
    <td>".$row['s_contact']."</td>
    <td>".$row['p_contact']."</td>
    <td>".$row['v_date']."</td>
    </tr>";
    $array[$index]=$table;
    if($i==30){
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
<title>College Synergy Visitor Log</title>
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
	font-size: 20px;
}

table, th, td {
    padding: 10px;
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
				<p><small><span style="font-size:20px; font-weight:bold">College Synergy Visitor Log</span></small>
			</div>
			<thead>
				<tr>
                    <th>No</th>
					<th>Student Name</th>
					<th>Student Contact</th>
					<th>Parent Contact</th>
					<th>Visitor Date</th>
				</tr>
			</thead>
			<tbody>
				<?php 
                    $num=count($array);
                    if($num==0){
                        echo "<tr ><td  colspan='5' style='text-align:center;'>None data between following date($_POST[daterange])</td></tr>";
                    }else{
                        echo $array[$a];
                    }
                ?>
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
    newWin.document.write("table{ border-collapse: collapse;font-size: 20px;}table, th, td {border: 1px solid black;} td{text-align:left;padding-left:2px;}");
    newWin.document.write("</style>");
    newWin.document.write(div.innerHTML);
    newWin.location.reload();
    newWin.focus();
    newWin.print();
    newWin.close();
}
</script>
