<?php 
include("include/db.php");

$issue=$_POST['value'];
$last_id="";
if($issue!=""){
    $qry=mysqli_query($conn,"insert into ptpk_issue(issue) value('".$issue."')");
    $last_id=mysqli_insert_id($conn);
}
$select=mysqli_query($conn,"select * from ptpk_issue");
echo "<option>Choose</option>";
while($result=mysqli_fetch_array($select)){

?>
<option <?php if($result["id"]==$last_id){echo "selected=''selected";} ?> value="<?=$result["id"]?>"><?=$result['issue']?></option>

<?php }?>