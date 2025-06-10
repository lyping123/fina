<?php
require('../include/db.php');
$q=$_REQUEST["ql"]; 
$qry = "SELECT * FROM school_list WHERE name_school='".$q."' AND s_status='ACTIVE'";
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($result);
$c_row = mysqli_num_rows($result);
if($c_row >= 1){
?>
                <div class="form-group">
                    <label>NRIC</label>
                    <input type="text" class="form-control" name="ic" value="<?=$row['ic']?>" required>
                </div>
<?php }?>  