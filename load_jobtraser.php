<?php
include("include/db.php");

for($i=19;$i<=26;$i++){
    $select="select * from job_tracer where batch='$i' and c_id='5' order by s_name";
    $sttr=mysqli_query($conn,$select);
    echo "<table>";
    while($row=mysqli_fetch_array($sttr)){
        echo "<tr>";
        echo "<td>$row[s_name]</td>";
        echo "<td>'$row[s_contact]</td>";
        echo "<td>'$row[s_ic]</td>";
        echo "<td>$row[company_name]</td>";
        echo "<td>$row[company_address]</td>";
        echo "<td>'$row[company_contact]</td>";
        echo "<td>$row[position]</td>";
        echo "<td>$row[salary]</td>";
        echo "<td>$row[start_working_date]</td>";
        echo "</tr>";
    }

    echo "</table>";

    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";

}

?>