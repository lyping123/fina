<?php
include_once('include/db.php');

	$qry="SELECT * FROM pre_registration WHERE status = 'ACTIVE'";
	$result = mysqli_query($conn, $qry);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pre Register List</title>
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
        margin: 10mm 0mm 10mm 0mm; /* margin you want for the content */
		-webkit-print-color-adjust:exact;
    }
</style>

<style>

table {
    border-collapse: collapse;
	font-size: 13px;
}

table, th, td {
    border: 1px solid black;
}
</style>
    <div style="display:inline-block; padding:0px 20px">
    	<p><small><span style="font-size:24px; font-weight:bold">Pre Register List</span></small>
    </div>
    
    <div class="table-responsive">
        <table id="mytable" class="table table-bordred table-striped" style="width:100%">
           
           <thead>
                <th>Name</th>
                <th>IC</th>
                <th>Nationality</th>
                <th>Race</th>
                <th>Address</th>
                <th>Postcode</th>
                <th>State</th>
                <th>Contact(House)</th>
                <th>Contact(H/P)</th>
                <th>Contact(Parent)</th>
                <th>Email</th>
                <th>Birthday</th>
                <th>Gender</th>
                <th>Marital Status</th>
                <th>Religion</th>
                <th>Secondary School</th>
                <th>Register Date</th>
           </thead>
           <tbody>
    <?php
        while($row = mysqli_fetch_array($result)){
    ?>
            <tr>
                <td><?=$row['s_name']?></td>
                <td><?=$row['ic']?></td>
                <td><?=$row['nationality']?></td>
                <td><?=$row['race']?></td>
                <td><?=$row['r_address']?></td>
                <td><?=$row['r_postcode']?></td>
                <td><?=$row['r_state']?></td>
                <td><?=$row['h_contact']?></td>
                <td><?=$row['hp_contact']?></td>
                <td><?=$row['guardian']?></td>
                <td><?=$row['s_email']?></td>
                <td><?=$row['birthday']?></td>
                <td><?=$row['gender']?></td>
                <td><?=$row['m_status']?></td>
                <td><?=$row['religion']?></td>
                <td><?=$row['secondary_school']?></td>
                <td><?=$row['createdate']?></td>
            </tr>
    <?php }?>
            </tbody>
        </table>
           
    </div>
</div>
</body>
</html>