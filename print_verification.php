<?php
include_once('include/db.php');

if($_POST['course'] == 'All'){
	$course = 'All Department';
	$value = "";
}else{
	$course = $_POST['course'];
	$value = " AND c.course = '".$_POST['course']."'";
}
$qry = "SELECT * FROM verification AS v
		LEFT JOIN student AS s ON s.id = v.s_name
		INNER JOIN course AS c ON c.id = v.department
		WHERE v.v_status = 'ACTIVE'".$value." ORDER BY c.course,s.s_name ASC";
$result = mysqli_query($conn,$qry);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Verification List (<?=$course?>)</title>
</head>

<body onload="window.print()">
<div style=" width:100%; margin-left:auto; margin-right:auto;">

  
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

<style>

table {
    border-collapse: collapse;
	font-size: 10px;
}

table, th, td {
    border: 1px solid black;
}
	
td {
    text-align: center;
}
</style>
	<div class="table-responsive">
		<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
			<div style="display:inline-block; padding:0px 20px">
				<p><small><span style="font-size:20px; font-weight:bold">Verification List (<?=$course?>)</span></small>
			</div>
			<thead>
				<tr>
					<th>Student</th>
					<th>IC</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Department</th>
					<th>Course Name</th>
					<th>CGPA</th>
				</tr>
			</thead>
			<tbody>
				<?php while($row = mysqli_fetch_array($result)){?>
				<tr>
					<td><?php if(!empty($row['s_name'])){ echo $row['s_name'];}else{ echo $row[1];}?></td>
					<td><?=$row['s_ic']?></td>
					<td><?=$row['s_date']?></td>
					<td><?=$row['e_date']?></td>
					<td><?=$row['course']?></td>
					<td><?=$row['course_name']?></td>
					<td><?=$row['s5']?></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
           
    </div>
</div>
</body>
</html>