<?php 
include("include/db.php");
$qry="SELECT s.*,l.l_name,stu.course,stu.s_name,stu.hp_contact,sg.g_name,sg.start_date,sg.end_date FROM school s 
INNER JOIN student stu on s.s_id=stu.id
LEFT JOIN student_group_list as sgl on sgl.s_id=stu.id
LEFT JOIN student_group as sg on sg.id=sgl.g_id
LEFT JOIN login as l on l.id=sg.p_id
WHERE s.name_school like '%".$_POST['name']."%' AND stu.s_status='ACTIVE'
ORDER BY stu.s_name";

$sttr=mysqli_query($conn,$qry);
$num=mysqli_num_rows($sttr);
$no=1;

?>
<!DOCTYPE html>
<html>
<head>
    <title>Print School Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #333;
            padding: 10px;
            text-align: left;
        }
        th {
            background: #f2f2f2;
        }
        @media print {
            button#printBtn {
                display: none;
            }
        }
    </style>
</head>
<body>
    <button id="printBtn" onclick="window.print()">Print</button>
    <h2>School Registration Details</h2>
    <table>
        <thead>
            <th>No</th>
            <th>school Name</th>
            <th>Student Name</th>
            <th>Student contact</th>
            <th>Course</th>
            <th>Lectural</th>
            <th>Dafta JPK</th>
            <th>School Address</th>
        </thead>
        <tbody>
            <?php while($row=mysqli_fetch_array($sttr)){  ?>
                <tr>
                    <td><?=$no++?></td>
                     <td><?=$row["name_school"]?></td>
                    <td><?=$row["s_name"]?></td>
                    <td><?=$row["hp_contact"]?></td>
                    <td><?=$row["course"]?></td>
                    <td><?=$row["l_name"]?></td>
                    <td><?=$row["start_date"]." - ".$row["end_date"]?></td>
                    <td><?=$row["location"]?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>