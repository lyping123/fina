<?php 
$conn=new mysqli("localhost","root","","online_class");
if(isset($_GET["value"]) && $_GET["value"]!==""){
    $value=$_GET["value"];
    $qry="select * from namelist where s_name like '%$value%' or gender like '$value%' or age like '$value%' or date_join like '$value%'";
}else{
    $value="";
    $qry="select * from namelist";
}
//$type=$_GET["type"];

//$qry="select * from namelist where s_name like '%$value%' or gender like '%$value%' ";
$sttr=mysqli_query($conn,$qry);

while($result=mysqli_fetch_array($sttr)){
    echo "<tr>";
    echo "<td>$result[s_name]</td>";
    echo "<td>$result[gender]</td>";
    echo "<td>$result[age]</td>";
    echo "<td>$result[date_join]</td>";
    echo "</tr>";
}
?>